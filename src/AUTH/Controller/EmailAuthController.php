<?php
namespace AUTH\Controller;

use PSFS\base\config\Config;
use PSFS\base\Request;
use PSFS\base\Security;

class EmailAuthController extends AUTHController {

    /**
     * @GET
     * @route /auth/email
     */
    public function requestLogin() {
        Request::getInstance()->redirect($this->srv->getAuthUrl());
    }

    /**
     * @GET
     * @route /auth/email/callback
     */
    public function loginCallback() {
        $user = $this->srv->authenticate($this->getRequest()->getQueryParams());
        Security::getInstance()->updateUser($user);
        return $this->redirect(Config::getParam('login.action'));
    }

}