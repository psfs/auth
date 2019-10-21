<?php
namespace AUTH\Dto;

use AUTH\Models\LoginAccountQuery;
use AUTH\Models\LoginProvider;
use AUTH\Models\LoginSessionQuery;
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
    public $first_name;
    /**
     * @var string
     * @label Last name from the external provider
     */
    public $last_name;
    /**
     * @var string
     * @label Photo url from the external provider
     */
    public $photo;
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
    public $access_token;
    /**
     * @var string
     * @label REfresh token for some cases
     */
    public $refresh_token;
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
    public $session_token;

    /**
     * @param \Auth\Models\LoginProvider $provider
     * @param boolean $verified
     */
    public function hydrate(LoginProvider $provider, $verified = true) {
        if(null !== $this->id) {
            $this->account = LoginAccountQuery::getAccountByIdentifier($this->id, $provider);
            if($this->account->isNew()) {
                $this->account->setAccessToken($this->access_token);
                $this->account->setExpireDate($this->expires);
                $this->account->setId($this->id);
            }
            $this->account->setIdSocial($provider->getPrimaryKey());
            if(!empty($this->refresh_token)) {
                $this->account->setRefreshToken($this->refresh_token);
            }
            if(!empty($this->email)) {
                $this->account->setEmail($this->email);
            }
            $this->account->setVerified($verified);
            $this->account->save();
            $session = LoginSessionQuery::getLastSession($this->account);
            $session->setIdAccount($this->account->getPrimaryKey());
            $session->setDevice($_SERVER['HTTP_USER_AGENT']);
            $session->setIP(AUTHService::getIpAddress());
            $session->setToken(hash_hmac('sha256', $this->id, $provider->getSecret()));
            $session->save();
            $this->session_token = $session->getToken();
        }
    }

    /**
     * Close user session
     */
    public function closeSession() {
        if(null !== $this->session_token) {
            $session = LoginSessionQuery::checkToken($this->session_token);
            if(null !== $session) {
                $session->setActive(false);
                $session->save();
            }
        }
        Security::getInstance()->updateUser(null);
        Security::getInstance()->updateSession(true);
    }
}