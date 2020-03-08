<?php
namespace AUTH\Dto;

use PSFS\base\dto\Dto;

/**
 * Class LoginDto
 * @package AUTH\Dto
 */
class LoginDto extends Dto {
    /**
     * @var string
     * @required
     * @label Identifier to look for
     */
    public $authKey;
    /**
     * @var string
     * @required
     * @label Password for the auth key(access token in case of external providers)
     */
    public $password;

    /**
     * @var string
     * @label PSFS provider code
     * @values EMAIL,GOOGLE,FACEBOOK,TWITTER,LINKEDIN,OFFICE
     * @default EMAIL
     */
    public $provider;
}