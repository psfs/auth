<?php
namespace AUTH\Controller;
use AUTH\Services\GoogleService;
use PSFS\base\config\Config;
use PSFS\base\Request;
use PSFS\base\Security;

/**
 * Class GoogleAuthController
 * @package AUTH\Controller
 */
class GoogleAuthController extends AUTHController {

    /**
     * @Injectable
     * @var \AUTH\Services\GoogleService
     */
    protected $srv;

    /**
     * @GET
     * @route /auth/google
     */
    public function requestLogin() {
        Request::getInstance()->redirect($this->srv->getAuthUrl());
    }

    /**
     * @GET
     * @route /auth/google/callback
     */
    public function loginCallback() {
        $user = $this->srv->authenticate($this->getRequest()->getQueryParams());
        Security::getInstance()->updateUser($user);
        return $this->redirect(Config::getParam('login.action'));
    }

    /**
     * @GET
     * @route /register/google
     */
    public function requestRegistration() {
        Request::getInstance()->redirect($this->srv->getAuthUrl(GoogleService::FLOW_REGISTER));
    }

    /**
     * @GET
     * @route /register/google/callback
     */
    public function registerCallback() {
        $user = $this->srv->authenticate($this->getRequest()->getQueryParams(), GoogleService::FLOW_REGISTER);
        Security::getInstance()->updateUser($user);
        return $this->redirect(Config::getParam('login.action'));
    }
}