<?php
namespace AUTH\Services;

use AUTH\Dto\AuthUserDto;
use AUTH\Dto\GoogleCheckDto;
use AUTH\Exception\InvalidCallbackParametersException;
use AUTH\Models\Map\LoginProviderTableMap;
use AUTH\Services\base\AUTHService;
use PSFS\base\config\Config;
use PSFS\base\exception\ApiException;
use PSFS\base\exception\GeneratorException;
use PSFS\base\Router;

/**
 * Class GoogleService
 * @package AUTH\Services
 */
class GoogleService extends AUTHService {
    /**
     * @return string
     */
    public function getProviderName()
    {
        return LoginProviderTableMap::COL_NAME_GOOGLE;
    }

    protected function getProviderDefaultScopes()
    {
        return [
            \Google_Service_Plus::PLUS_LOGIN,
            \Google_Service_Plus::PLUS_ME,
            \Google_Service_Plus::USERINFO_EMAIL,
            \Google_Service_Plus::USERINFO_PROFILE,
        ];
    }

    /**
     * @param int $flow
     * @return string
     */
    public function getAuthUrl($flow = self::FLOW_LOGIN)
    {
        $client = $this->getClient($this->base . Router::getInstance()->getRoute('auth-google-callback', false), $flow);
        return $client->createAuthUrl();
    }

    /**
     * @param array $query
     * @param int $flow
     * @return AuthUserDto|null
     * @throws GeneratorException
     * @throws InvalidCallbackParametersException
     */
    public function authenticate(array $query, $flow = self::FLOW_LOGIN)
    {
        if(!array_key_exists('code', $query)) {
            throw new InvalidCallbackParametersException();
        }
        $client = $this->getClient($this->base . Router::getInstance()->getRoute('auth-google-callback', false), $flow);
        $token = $client->fetchAccessTokenWithAuthCode($query['code']);
        return $this->getUser($token);
    }

    /**
     * @param array $auth
     * @param int $flow
     * @return AuthUserDto|null
     * @throws GeneratorException
     */
    public function getUser(array $auth, $flow = self::FLOW_LOGIN)
    {
        if(array_key_exists('error', $auth)) {
            throw new ApiException($auth['error'], 400);
        }
        $client = $this->getClient($this->base . Router::getInstance()->getRoute('auth-google-callback', false), $flow);
        $client->setAccessToken($auth);
        $googlePlus = new \Google_Service_Plus($client);
        $profile = $googlePlus->people->get('me');
        $user = new AuthUserDto();
        $user->id = $profile->getId();
        $user->name = $profile->getDisplayName();
        $user->firstName = $profile->getName()->getGivenName();
        $user->lastName = $profile->getName()->getFamilyName();
        $user->photoUrl = array_shift(explode('?', $profile->getImage()->getUrl()));
        $user->accessToken = $auth['access_token'];
        $user->expires = new \DateTime();
        $user->expires->modify($auth['expires_in'] . ' seconds');
        if(array_key_exists('refresh_token', $auth)) {
            $user->refreshToken = $auth['refresh_token'];
        }
        /** @var \Google_Service_Plus_PersonEmails $email */
        foreach($profile->getEmails() as $email) {
            if($email->getType() == 'account') {
                $user->email = $email->getValue();
                break;
            }
        }
        $user->raw = $profile->toSimpleObject();
        $user->hydrate($this->provider);
        return $user;
    }

    /**
     * @param string $callbackUri
     * @param integer $flow
     * @return \Google_Client
     */
    public function getClient($callbackUri, $flow = self::FLOW_LOGIN)
    {
        if(null === self::$client) {
            $config = [
                'client_id' => $this->provider->getClient(),
                'client_secret' => $this->provider->getSecret(),
                'redirect_uri' => $callbackUri,
            ];
            if(self::FLOW_REGISTER === $flow) {
                $config['approval_prompt'] = Config::getParam('google.prompt', false);
            }
            self::$client = new \Google_Client($config);
            self::$client->setAccessType(Config::getParam('google.accessType', 'offline'));
            self::$client->setScopes($this->getScopes());
        }

        return self::$client;
    }

    /**
     * @param $idToken
     * @return GoogleCheckDto
     * @throws GeneratorException
     * @throws \ReflectionException
     */
    public function verifyIdToken($idToken) {
        $client = $this->getClient($this->base . Router::getInstance()->getRoute('auth-google-callback', false));
        $verification = $client->verifyIdToken($idToken);
        $response = new GoogleCheckDto();
        if(false !== $verification){
            $response->fromArray($verification);
            $response->sub = (string)$response->sub;
            $response->iat = (string)$response->iat;
            $response->exp = (string)$response->exp;
        }
        return $response;
    }
}
