<?php
namespace AUTH\Types;

use AUTH\Models\LoginSessionQuery;
use PSFS\base\dto\JsonResponse;
use PSFS\base\Request;
use PSFS\base\types\Api;

/**
 * Class SessionAuthApi
 * @package AUTH\Type
 */
abstract class SessionAuthApi extends Api
{
    /**
     * @var bool
     */
    protected $isPublic = false;

    /**
     * @Injectable
     * @var \PSFS\base\Security
     */
    protected $security;

    public function init()
    {
        parent::init();
        $this->checkAuth();
    }

    /**
     * Get hearder Authorization
     * */
    private function getAuthorizationHeader()
    {
        $headers = null;
        if (null !== Request::getInstance()->getHeader('Authorization')) {
            $headers = trim($_SERVER["Authorization"]);
        } else if (null !== Request::getInstance()->getHeader('HTTP_AUTHORIZATION')) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
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
     * get access token from header
     * */
    private function getBearerToken()
    {
        $headers = $this->getAuthorizationHeader();
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    /**
     * @return string
     */
    private function checkAuth()
    {
        if (!$this->security->canAccessRestrictedAdmin() && !$this->isPublic) {
            $token = $this->getBearerToken();
            if (empty($token)) {
                return $this->json(new JsonResponse(_('Not authorized, missing Api Token in the request'), false), 401);
            }
            if (!LoginSessionQuery::checkToken($token)) {
                return $this->json(new JsonResponse(_('Not authorized, token not valid'), false), 401);
            }
        }
    }
}