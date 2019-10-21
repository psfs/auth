<?php
namespace AUTH\Controller;

use AUTH\Services\OfficeService;
use PSFS\base\Request;

/**
 * Class FacebookAuthController
 * @package AUTH\Controller
 */
class OfficeAuthController extends AUTHController {

    /**
     * @Injectable
     * @var \AUTH\Services\OfficeService
     */
    protected $srv;

    /**
     * @GET
     * @route /auth/Live
     */
    public function requestLogin() {
        Request::getInstance()->redirect($this->srv->getAuthUrl());
    }

    /**
     * @GET
     * @route /auth/Live/callback
     */
    public function loginCallback() {
        return $this->authenticate($this->getRequest()->getQueryParams(), OfficeService::FLOW_LOGIN);
    }

    /**
     * @GET
     * @route /register/Live
     */
    public function requestRegistration() {
        Request::getInstance()->redirect($this->srv->getAuthUrl(OfficeService::FLOW_REGISTER));
    }

    /**
     * @GET
     * @route /register/Live/callback
     */
    public function registerCallback() {
        return $this->authenticate($this->getRequest()->getQueryParams(), OfficeService::FLOW_REGISTER);
    }
}