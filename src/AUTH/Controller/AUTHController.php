<?php
namespace AUTH\Controller;

use AUTH\Controller\base\AUTHBaseController;
use AUTH\Exception\AuthRedirectNotDefinedException;
use AUTH\Services\EmailService;
use PSFS\base\config\Config;
use PSFS\base\dto\JsonResponse;
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
abstract class AUTHController extends AUTHBaseController {

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
            $route = $this->srv->getPath('login.action');
        } catch (\Exception $e) {
            Logger::log($e->getMessage(), LOG_ERR);
            $route = $this->srv->getPath('login.cancel');
            Security::getInstance()->setFlash('callback_message', $e->getMessage());
        }
        return $this->getRequest()->redirect($this->srv->base . $this->getRoute($route));
    }
}
