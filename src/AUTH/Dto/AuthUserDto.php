<?php
namespace AUTH\Dto;

use AUTH\Models\LoginAccount;
use AUTH\Models\LoginAccountQuery;
use AUTH\Models\LoginProvider;
use AUTH\Models\LoginSessionQuery;
use AUTH\Services\AUTHService;
use PSFS\base\dto\Dto;
use PSFS\base\Security;

class AuthUserDto extends Dto {
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $first_name;
    /**
     * @var string
     */
    public $last_name;
    /**
     * @var string
     */
    public $photo;
    /**
     * @var string
     */
    public $email;
    /**
     * @var string
     */
    public $access_token;
    /**
     * @var string
     */
    public $refresh_token;
    /**
     * @var \DateTime
     */
    public $expires;
    /**
     * @var array
     */
    public $raw;
    /**
     * @var LoginAccount
     */
    public $account;
    /**
     * @var string
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
            $session->setIP(AUTHService::get_ip_address());
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