<?php
namespace AUTH\Types;
use AUTH\Models\LoginAccount;
use PSFS\base\Request;

/**
 * Trait SessionAuthTrait
 * @package AUTH\Types
 */
trait SessionAuthTrait {

    /**
     * @var string
     * @header Authorization
     * @label Token de autenticación REST
     * @default Bearer
     */
    protected $token;

    /**
     * @var bool
     */
    protected $public = false;

    /**
     * @return bool
     */
    public function isPublic()
    {
        return $this->public;
    }

    /**
     * @param bool $public
     */
    public function setPublic($public)
    {
        $this->public = $public;
    }

    /**
     * @Injectable
     * @var \PSFS\base\Security
     */
    protected $security;

    /**
     * @var LoginAccount
     */
    protected $account;

    /**
     * @var string
     */
    protected $customer;

    /**
     * @return string|null
     */
    private static function getAuthorizationHeader()
    {
        $headers = null;
        if (null !== Request::header('Authorization')) {
            $headers = trim(Request::header('Authorization'));
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }

    /**
     * @return mixed|null
     */
    public static function getBearerToken()
    {
        $headers = self::getAuthorizationHeader();
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }
}