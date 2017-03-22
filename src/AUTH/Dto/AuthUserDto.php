<?php
namespace AUTH\Dto;

use AUTH\Models\LoginAccount;
use AUTH\Models\LoginAccountQuery;
use AUTH\Models\LoginProvider;
use PSFS\base\dto\Dto;

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
     * @param \Auth\Models\LoginProvider $provider
     */
    public function hydrate(LoginProvider $provider) {
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
            $this->account->save();
        }
    }
}