<?php
namespace AUTH\Services;

use AUTH\Dto\AuthUserDto;
use AUTH\Exception\EmailAlreadyExistsException;
use AUTH\Exception\EmailNotExistsException;
use AUTH\Exception\EmailProviderMissingParametersException;
use AUTH\Exception\EmailResetFailedException;
use AUTH\Exception\EmailWrongPasswordException;
use AUTH\Models\LoginAccountQuery;
use AUTH\Models\LoginProviderQuery;
use AUTH\Models\Map\LoginProviderTableMap;
use AUTH\Services\base\AUTHService;
use PSFS\base\config\Config;
use PSFS\base\Logger;

class EmailService extends AUTHService
{
    const EMAIL_ERROR_RESET_TOKEN_NOT_FOUND = 460;
    const EMAIL_ERROR_RESET_PASS_NOT_FOUND = 461;
    const EMAIL_ERROR_RESET_PASS_NOT_VALID = 462;
    const EMAIL_ERROR_RESET_INVALID_TOKEN = 463;
    const EMAIL_ERROR_RESET_FORBIDDEN = 464;
    const EMAIL_ERROR_RESET_GENERAL_ERROR = 465;

    /**
     * @inheritDoc
     */
    public function getProviderName()
    {
        return LoginProviderTableMap::COL_NAME_EMAIL;
    }

    /**
     * Not used
     * @inheritDoc
     */
    public function getClient($callbackUri, $flow = self::FLOW_LOGIN)
    {
        return LoginProviderQuery::getProvider($this->getProviderName(), Config::getParam('debug'), Config::getParam('psfs.auth.customer_code'));
    }

    /**
     * Not used
     * @inheritDoc
     */
    public function getAuthUrl($flow = self::FLOW_LOGIN)
    {
       return null;
    }

    /**
     * @param string $password
     * @throws EmailWrongPasswordException
     */
    public static function checkPassword($password) {
        if(!strlen($password)) {
            throw new EmailWrongPasswordException(_('Contraseña vacía'), 400);
        }
        if(strlen($password) < Config::getParam('auth.email.passlen', 6)) {
            throw new EmailWrongPasswordException(str_replace('%s%', Config::getParam('auth.email.passlen', 6), _('Contraseña demasiado corta, debe tener al menos %s% caracteres')), 400);
        }
        $pattern = Config::getParam('auth.email.pattern');
        if(null !== $pattern) {
            try {
                if(!preg_match($pattern, $password)) {
                    throw new EmailWrongPasswordException(_(Config::getParam('auth.email.pattern.message', 'Contraseña no segura, prueba a incluir caracteres y números')), 400);
                }
            } catch(\Exception $e) {
                if($e instanceof EmailWrongPasswordException) {
                    throw $e;
                }
                Logger::log($e->getMessage(), LOG_ERR);
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function authenticate(array $query, $flow = self::FLOW_LOGIN)
    {
        if(!array_key_exists('email', $query)) {
            throw new EmailProviderMissingParametersException(_('El campo email es obligatorio'), 400);
        }
        if(!array_key_exists('password', $query)) {
            throw new EmailProviderMissingParametersException(_('El campo contraseña es obligatorio'), 400);
        }
        if($flow === self::FLOW_REGISTER) {
            self::checkPassword($query['password']);
        }
        return $this->getUser($query, $flow);
    }

    /**
     * @param string $x
     * @return string
     */
    private static function strtohex($x)
    {
        $s='';
        foreach (str_split($x) as $c) $s.=sprintf("%02X",ord($c));
        return($s);
    }

    /**
     * @param string $identifier
     * @param string $password
     * @return string
     */
    public static function encryptPassword($identifier, $password) {
        $iv = self::strtohex($identifier);
        $key = self::strtohex(Config::getParam('auth.email.phrase', 'psfs'));
        $method = Config::getParam('auth.email.method', 'aes-128-cbc');
        return bin2hex(@openssl_encrypt($password, $method, $key, OPENSSL_RAW_DATA, $iv));
    }


    /**
     * @inheritDoc
     */
    public function getUser(array $auth, $flow = self::FLOW_LOGIN)
    {
        $email = strtolower($auth['email']);
        $identifier = sha1($email);
        $access_token = self::encryptPassword($identifier, $auth['password']);
        $userExists = LoginAccountQuery::existsIdentifierForProvider($identifier, $this->provider, true);
        if(self::FLOW_REGISTER === $flow && $userExists) {
            throw new EmailAlreadyExistsException(_('Email en uso'), 403);
        } elseif ($flow === self::FLOW_LOGIN && !$userExists) {
            throw new EmailNotExistsException(_('El email no existe'), 404);
        } elseif($flow === self::FLOW_LOGIN) {
            $userExistsWithPassword = LoginAccountQuery::existsIdentifierWithPassword($identifier, $access_token, $this->provider);
            if(!$userExistsWithPassword) {
                throw new EmailNotExistsException(_('Contraseña no válida'), 401);
            }
        }
        $user = new AuthUserDto();
        $user->fromArray($auth);
        $user->id = $identifier;
        $user->access_token = $access_token;
        $user->raw = $auth;
        $user->hydrate($this->provider, self::FLOW_LOGIN === $flow);
        return $user;
    }

    /**
     * @param array $data
     * @return bool
     * @throws EmailResetFailedException
     * @throws \Exception
     */
    public function resetPassword(array $data) {
        if(array_key_exists('token', $data)) {
            if(array_key_exists('password', $data)) {
                try {
                    EmailService::checkPassword($data['password']);
                    $account = LoginAccountQuery::getAccountForReset($data['token']);
                    if(null !== $account) {
                        $now = new \DateTime();
                        if(null !== $account->getRefreshRequest() && $now < $account->getRefreshRequest()) {
                            $password = EmailService::encryptPassword($account->getId(), $data['password']);
                            $account->setAccessToken($password)
                                ->setRefreshToken($password)
                                ->setRefreshRequest(null)
                                ->setResetToken(null);
                            $reseted = false !== $account->save();
                        } else {
                            throw new EmailResetFailedException(_('Ha expirado el plazo para resetear la contraseña'), self::EMAIL_ERROR_RESET_FORBIDDEN);
                        }
                    } else {
                        throw new EmailResetFailedException(_('No se ha encontrado el usuario para resetear la contraseña'), self::EMAIL_ERROR_RESET_INVALID_TOKEN);
                    }
                } catch(\Exception $e) {
                    Logger::log($e->getMessage(), LOG_ERR, $data);
                    if($e instanceof EmailWrongPasswordException) {
                        throw new EmailResetFailedException($e->getMessage(), self::EMAIL_ERROR_RESET_PASS_NOT_VALID);
                    } else {
                        throw $e;
                    }
                }
            } else {
                throw new EmailResetFailedException(_('Es necesario una nueva password'), self::EMAIL_ERROR_RESET_PASS_NOT_FOUND);
            }
        } else {
            throw new EmailResetFailedException(_('Es necesario el token del usuario'), self::EMAIL_ERROR_RESET_TOKEN_NOT_FOUND);
        }
        return $reseted;
    }
}