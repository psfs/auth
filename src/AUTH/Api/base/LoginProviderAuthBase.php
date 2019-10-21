<?php
namespace AUTH\Api\base;

use AUTH\Exception\AuthRedirectNotDefinedException;
use AUTH\Models\Map\LoginAccountTableMap;
use PSFS\base\config\Config;
use PSFS\base\dto\JsonResponse;
use PSFS\base\Logger;
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
    protected $auth;

    /**
     * @param array $query
     * @param integer $flow
     * @return mixed
     */
    protected function authenticate(array $query, $flow) {
        try {
            $user = $this->srv->authenticate($query, $flow);
            Security::getInstance()->updateUser(serialize($user));
            $route = Config::getParam('login.action');
        } catch (\Exception $e) {
            Logger::log($e->getMessage(), LOG_ERR);
            $route = Config::getParam('login.cancel');
            Security::getInstance()->setFlash('callback_message', $e->getMessage());
        }
        return $this->getRequest()->redirect($this->srv->base . $this->getRoute($route));
    }
}