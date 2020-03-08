<?php
namespace AUTH\Api\base;

use AUTH\Exception\AuthRedirectNotDefinedException;
use AUTH\Models\LoginPath;
use AUTH\Models\Map\LoginAccountTableMap;
use AUTH\Models\Map\LoginPathTableMap;
use AUTH\Services\base\AUTHService;
use PSFS\base\config\Config;
use PSFS\base\dto\JsonResponse;
use PSFS\base\Logger;
use PSFS\base\Request;
use PSFS\base\Security;
use PSFS\base\types\CustomApi;

/**
 * Class LoginProviderAuthBase
 * @package AUTH\Api\base
 */
abstract class LoginProviderAuthBase extends CustomApi {

    /**
     * @var \AUTH\Services\base\AUTHService
     */
    protected $srv;

    /**
     * @var string
     * @header X-AUTH-CUSTOMER
     * @label Customer code for checking auth credentials
     * @default psfs
     */
    protected $customer;

    public function init()
    {
        $this->customer = Request::header(AUTHService::HEADER_AUTH_CUSTOMER);
        parent::init();
    }

    /**
     * @param array $query
     * @param integer $flow
     * @return mixed
     */
    protected function authenticate(array $query, $flow) {
        try {
            $user = $this->srv->authenticate($query, $flow);
            Security::getInstance()->updateUser(serialize($user));
            $route = $this->srv->getPath(LoginPathTableMap::COL_TYPE_LOGIN_OK);
        } catch (\Exception $e) {
            Logger::log($e->getMessage(), LOG_ERR);
            $route = $this->srv->getPath(LoginPathTableMap::COL_TYPE_LOGIN_ERROR);
            Security::getInstance()->setFlash('callback_message', $e->getMessage());
        }
        return $this->getRequest()->redirect($this->srv->base . $this->getRoute($route));
    }
}
