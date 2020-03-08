<?php
namespace AUTH\Dto;

use PSFS\base\dto\Dto;

/**
 * Class RegisterDto
 * @package AUTH\Dto
 */
class RegisterDto extends Dto {
    /**
     * @var string
     * @label User name
     */
    public $name;
    /**
     * @var string
     * @label User first name
     */
    public $firstName;
    /**
     * @var string
     * @label User last name
     */
    public $lastName;
    /**
     * @var string
     * @label User photo url
     */
    public $photoUrl;

    /**
     * @var string
     * @required
     * @label User email
     */
    public $email;
    /**
     * @var string
     * @required
     * @label User password, min 8 characters
     */
    public $password;
}