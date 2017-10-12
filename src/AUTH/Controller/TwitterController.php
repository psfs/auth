<?php
namespace AUTH\Controller;

use AUTH\Services\TwitterService;
use PSFS\base\Request;

/**
 * Class TwitterController
 * @package AUTH\Controller
 */
class TwitterController extends AUTHController {
    /**
     * @Injectable
     * @var \AUTH\Services\TwitterService
     */
    protected $srv;

    /**
     * @GET
     * @route /auth/Twitter
     */
    public function requestLogin() {
        Request::getInstance()->redirect($this->srv->getAuthUrl());
    }

    /**
     * @GET
     * @route /auth/Twitter/callback
     */
    public function loginCallback() {
        return $this->authenticate($this->getRequest()->getQueryParams(), TwitterService::FLOW_LOGIN);
    }

    /**
     * @GET
     * @route /register/Twitter
     */
    public function requestRegistration() {
        Request::getInstance()->redirect($this->srv->getAuthUrl(TwitterService::FLOW_REGISTER));
    }

    /**
     * @GET
     * @route /register/Twitter/callback
     */
    public function registerCallback() {
        return $this->authenticate($this->getRequest()->getQueryParams(), TwitterService::FLOW_REGISTER);
    }
}