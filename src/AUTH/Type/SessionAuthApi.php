<?php
namespace AUTH\Type;

use AUTH\Models\LoginSessionQuery;
use PSFS\base\dto\JsonResponse;
use PSFS\base\Request;
use PSFS\base\types\Api;
use PSFS\base\types\SecureTrait;

/**
 * Class SessionAuthApi
 * @package AUTH\Type
 */
abstract class SessionAuthApi extends Api {
    use SecureTrait;

    public function init()
    {
        $this->checkAuth();
        parent::init();
    }

    private function checkAuth() {
        $token = Request::getInstance()->getHeader(self::HEADER_API_TOKEN);
        if(empty($token)) {
            return $this->json(new JsonResponse(_('Not authorized, missing Api Token in the request'), false), 401);
        }
        if(!LoginSessionQuery::checkToken($token)) {
            return $this->json(new JsonResponse(_('Not authorized, token not valid'), false), 401);
        }
    }
}