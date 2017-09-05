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
    function getModelTableMap()
    {
        return LoginAccountTableMap::getTableMap();
    }

    /**
     * @var \AUTH\Services\base\AUTHService
     */
    protected $auth;

    public function init()
    {
        if(null == Config::getParam('login.action')) {
            throw new AuthRedirectNotDefinedException(_('Es necesario que se parametrice la ruta de redirección después del login usando la variable login.action'), 503);
        }
        if(null == Config::getParam('logout.action')) {
            throw new AuthRedirectNotDefinedException(_('Es necesario que se parametrice la ruta de redirección después del logout usando la variable logout.action'), 503);
        }
        if(null == Config::getParam('login.cancel')) {
            throw new AuthRedirectNotDefinedException(_('Es necesario que se parametrice la ruta de redirección si el usuario cancela el login locin.cancel'), 503);
        }
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
            $route = Config::getParam('login.action');
        } catch (\Exception $e) {
            Logger::log($e->getMessage(), LOG_ERR);
            $route = Config::getParam('login.cancel');
            Security::getInstance()->setFlash('callback_message', $e->getMessage());
        }
        return $this->getRequest()->redirect($this->srv->base . $this->getRoute($route));
    }
}