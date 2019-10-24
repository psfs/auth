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