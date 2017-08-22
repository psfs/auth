<?php
namespace AUTH\Api;

use AUTH\Api\base\LoginProviderAuthBase;
use AUTH\Services\FacebookService;
use PSFS\base\Request;

/**
 * Class FacebookAuthApi
 * @package AUTH\Api
 * @Api Facebook
 */
class FacebookAuthApi extends LoginProviderAuthBase {
    /**
     * @Injectable
     * @var \AUTH\Services\FacebookService
     */
    protected $srv;

    /**
     * @label Solicitar login mediante Facebook
     * @GET
     * @route /auth/{__API__}
     * @return \PSFS\base\dto\JsonResponse(data={__API__})
     */
    public function requestLogin() {
        Request::getInstance()->redirect($this->srv->getAuthUrl());
    }

    /**
     * @label Callback del flujo OAuth para el login
     * @GET
     * @route /auth/{__API__}/callback
     * @return \PSFS\base\dto\JsonResponse(data={__API__})
     */
    public function loginCallback() {
        return $this->authenticate($this->getRequest()->getQueryParams(), FacebookService::FLOW_LOGIN);
    }

    /**
     * @label Solicitar registro mediante Facebook
     * @GET
     * @route /register/{__API__}
     * @return \PSFS\base\dto\JsonResponse(data={__API__})
     */
    public function requestRegistration() {
        Request::getInstance()->redirect($this->srv->getAuthUrl(FacebookService::FLOW_REGISTER));
    }

    /**
     * @label Callback del flujo OAuth para el registro
     * @GET
     * @route /register/{__API__}/callback
     * @return \PSFS\base\dto\JsonResponse(data={__API__})
     */
    public function registerCallback() {
        return $this->authenticate($this->getRequest()->getQueryParams(), FacebookService::FLOW_REGISTER);
    }
}