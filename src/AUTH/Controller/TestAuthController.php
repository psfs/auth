<?php
namespace AUTH\Controller;

use AUTH\Models\LoginProviderQuery;
use PSFS\base\config\Config;
use PSFS\base\Security;

/**
 * Class TestAuthController
 * @package AUTH\Controller
 */
class TestAuthController extends AUTHController {
    /**
     * @GET
     * @route /admin/PSFS/user
     * @label Test PSFS Auth User
     * @visible false
     */
    public function testLogin() {
        return $this->render('index.html.twig', [
            'user' => Security::getInstance()->getUser(),
            'providers' => LoginProviderQuery::getActiveProviders(Config::getParam('debug')),
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