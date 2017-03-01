<?php
namespace AUTH\Controller;
use AUTH\Controller\base\AUTHBaseController;
use AUTH\Exception\AuthRedirectNotDefinedException;
use PSFS\base\config\Config;
use PSFS\base\Router;
use PSFS\base\Security;

/**
* Class AUTHController
* @package AUTH\Controller
* @author Fran López <fran.lopez84@hotmail.es>
* @version 1.0
* @Api AUTH
* Autogenerated controller [2017-02-20 00:27:02]
*/
class AUTHController extends AUTHBaseController {

    public function init()
    {
        if(null == Config::getParam('login.action')) {
            throw new AuthRedirectNotDefinedException(_('Es necesario que se parametrice la ruta de redirección después del login usando la variable login.action'), 503);
        }
        if(null == Config::getParam('logout.action')) {
            throw new AuthRedirectNotDefinedException(_('Es necesario que se parametrice la ruta de redirección después del logout usando la variable logout.action'), 503);
        }
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function getMenu()
    {
        return Router::getInstance()->getAdminRoutes();
    }

    /**
     * @GET
     * @route /admin/PSFS/user
     * @label Test PSFS Auth User
     * @visible false
     */
    public function testLogin() {
        return $this->render('index.html.twig', [
            'user' => Security::getInstance()->getUser(),
        ]);
    }

    /**
     * @GET
     * @route /logout
     * @label Logout user session
     * @visible false
     */
    public function logout() {
        Security::getInstance()->updateUser(null);
        Security::getInstance()->updateSession(true);
        return $this->redirect(Config::getParam('logout.action'));
    }
}
