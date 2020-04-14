<?php
namespace AUTH\Dto;

use AUTH\Models\LoginAccountPassword;
use AUTH\Models\LoginAccountQuery;
use AUTH\Models\LoginProvider;
use AUTH\Models\LoginSessionQuery;
use AUTH\Models\Map\LoginProviderTableMap;
use AUTH\Services\base\AUTHService;
use PSFS\base\dto\Dto;
use PSFS\base\Security;

class AuthUserDto extends Dto {
    /**
     * @var string
     * @required
     * @label External identifier from the provider
     */
    public $id;
    /**
     * @var string
     * @required
     * @label Complete name or alias from the external provider
     */
    public $name;
    /**
     * @var string
     * @required
     * @label First name from the external provider
     */
    public $firstName;
    /**
     * @var string
     * @label Last name from the external provider
     */
    public $lastName;
    /**
     * @var string
     * @label Photo url from the external provider
     */
    public $photoUrl;
    /**
     * @var string
     * @label Email from the external provider
     */
    public $email;
    /**
     * @var string
     * @required
     * @label Access token from the external provider
     */
    public $accessToken;
    /**
     * @var string
     * @label REfresh token for some cases
     */
    public $refreshToken;
    /**
     * @var \DateTime
     * @label Expiration date for the access token
     */
    public $expires;
    /**
     * @var array
     * @label Raw data from the provider request
     */
    public $raw;
    /**
     * @var \AUTH\Models\LoginAccount
     * @label Account related with the AuthUserDto
     */
    public $account;
    /**
     * @var string
     * @required
     * @label Session token to authenticate the API requests
     */
    public $sessionToken;
    /**
     * @var bool
     */
    public $hasToChangePassword = false;

    /**
     * @param LoginProvider $provider
     * @param bool $verified
     * @param string $password
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function hydrate(LoginProvider $provider, $verified = true, $password = null) {
        if(null !== $this->id) {
            $this->account = LoginAccountQuery::getAccountByIdentifier($this->id, $provider);
            if($this->account->isNew()) {
                $this->account->setAccessToken($this->accessToken);
                $this->account->setExpireDate($this->expires);
                $this->account->setId($this->id);
            }
            $this->account->setIdSocial($provider->getPrimaryKey());
            if(!empty($this->refreshToken)) {
                $this->account->setRefreshToken($this->refreshToken);
            }
            if(!empty($this->email)) {
                $this->account->setEmail($this->email);
            }
            $this->account->setVerified($verified);
            if($this->account->isNew() && LoginProviderTableMap::COL_NAME_EMAIL === $provider->getName() && !empty($password)) {
                $now = new \DateTime();
                switch($provider->getExpiration()) {
                    case LoginProviderTableMap::COL_EXPIRATION_WEEKLY:
                        $now->modify($provider->getExpirationPeriod() . ' week');
                        break;
                    case LoginProviderTableMap::COL_EXPIRATION_MONTHLY:
                        $now->modify($provider->getExpirationPeriod() . ' month');
                        break;
                    case LoginProviderTableMap::COL_EXPIRATION_YEARLY:
                        $now->modify($provider->getExpirationPeriod() . ' year');
                        break;
                    default:
                        $now->modify('100 year');
                        break;
                }

                if($this->account->isNew()) {
                    $passwordHistory = new LoginAccountPassword();
                    $passwordHistory->setAccountPasswords($this->account)
                        ->setValue($password)
                        ->setExpirationDate($now);
                    $passwordHistory->save();
                }
            }
            $session = LoginSessionQuery::getLastSession($this->account);
            $session->setAccountSession($this->account);
            if($session->isNew() || $session->getIP() !== AUTHService::getIpAddress()) {
                $session->setDevice($_SERVER['HTTP_USER_AGENT']);
                $session->setIP(AUTHService::getIpAddress());
                $session->setToken(hash_hmac('sha256', $this->id . time(), $provider->getSecret()));
            }
            $this->sessionToken = $session->getToken();
            $this->account->save();
        }
    }

    /**
     * Close user session
     */
    public function closeSession() {
        if(null !== $this->sessionToken) {
            $session = LoginSessionQuery::checkToken($this->sessionToken);
            if(null !== $session) {
                $session->setActive(false);
                $session->save();
            }
        }
        Security::getInstance()->updateUser(null);
        Security::getInstance()->updateSession(true);
    }
}
