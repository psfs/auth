<?php
namespace AUTH\Controller;

use AUTH\Services\LinkedInService;
use PSFS\base\Request;

/**
 * Class LinkedInController
 * @package AUTH\Controller
 */
class LinkedInController extends AUTHController {
    /**
     * @Injectable
     * @var \AUTH\Services\LinkedInService
     */
    protected $srv;

    /**
     * @GET
     * @route /auth/LinkedIn
     */
    public function requestLogin() {
        Request::getInstance()->redirect($this->srv->getAuthUrl());
    }

    /**
     * @GET
     * @route /auth/LinkedIn/callback
     */
    public function loginCallback() {
        return $this->authenticate($this->getRequest()->getQueryParams(), LinkedInService::FLOW_LOGIN);
    }

    /**
     * @GET
     * @route /register/LinkedIn
     */
    public function requestRegistration() {
        Request::getInstance()->redirect($this->srv->getAuthUrl(LinkedInService::FLOW_REGISTER));
    }

    /**
     * @GET
     * @route /register/LinkedIn/callback
     */
    public function registerCallback() {
        return $this->authenticate($this->getRequest()->getQueryParams(), LinkedInService::FLOW_REGISTER);
    }
}