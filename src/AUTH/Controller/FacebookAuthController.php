<?php
namespace AUTH\Controller;

use AUTH\Services\FacebookService;
use PSFS\base\Request;

/**
 * Class FacebookAuthController
 * @package AUTH\Controller
 */
class FacebookAuthController extends AUTHController {

    /**
     * @Injectable
     * @var \AUTH\Services\FacebookService
     */
    protected $srv;

    /**
     * @GET
     * @route /auth/Facebook
     */
    public function requestLogin() {
        Request::getInstance()->redirect($this->srv->getAuthUrl());
    }

    /**
     * @GET
     * @route /auth/Facebook/callback
     */
    public function loginCallback() {
        return $this->authenticate($this->getRequest()->getQueryParams(), FacebookService::FLOW_LOGIN);
    }

    /**
     * @GET
     * @route /register/Facebook
     */
    public function requestRegistration() {
        Request::getInstance()->redirect($this->srv->getAuthUrl(FacebookService::FLOW_REGISTER));
    }

    /**
     * @GET
     * @route /register/Facebook/callback
     */
    public function registerCallback() {
        return $this->authenticate($this->getRequest()->getQueryParams(), FacebookService::FLOW_REGISTER);
    }
}