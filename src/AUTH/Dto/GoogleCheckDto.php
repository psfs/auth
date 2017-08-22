<?php
namespace AUTH\Dto;

use PSFS\base\dto\Dto;

class GoogleCheckDto extends Dto {
    /**
     * @var string
     */
    public $iss;
    /**
     * @var string
     */
    public $sub;
    /**
     * @var string
     */
    public $azp;
    /**
     * @var string
     */
    public $aud;
    /**
     * @var string
     */
    public $iat;
    /**
     * @var string
     */
    public $exp;
    /**
     * @var string
     */
    public $email;
    /**
     * @var string
     */
    public $email_verified;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $picture;
    /**
     * @var string
     */
    public $given_name;
    /**
     * @var string
     */
    public $family_name;
    /**
     * @var string
     */
    public $locale;
}