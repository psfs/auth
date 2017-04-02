<?php
namespace AUTH\Controller;
use AUTH\Controller\base\AUTHBaseController;
use AUTH\Exception\AuthRedirectNotDefinedException;
use AUTH\Services\base\AUTHService;
use PSFS\base\config\Config;
use PSFS\base\Logger;
use PSFS\base\Router;
use PSFS\base\Security;
use PSFS\base\types\helpers\AdminHelper;

/**
* Class AUTHController
* @package AUTH\Controller
* @author Fran López <fran.lopez84@hotmail.es>
* @version 1.0
* @Api AUTH
* Autogenerated controller [2017-02-20 00:27:02]
*/
class AUTHController extends AUTHBaseController {

    /**
     * @var AUTHService
     */
    protected $srv;

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

    public function getMenu()
    {
        return AdminHelper::getAdminRoutes(Router::getInstance()->getRoutes());
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
