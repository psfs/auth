<?php
namespace AUTH\Api;

use AUTH\Api\base\LoginProviderAuthBase;
use AUTH\Services\LinkedInService;
use PSFS\base\Request;

/**
 * Class LinkedInAuthApi
 * @package AUTH\Api
 * @Api Linkedin
 */
class LinkedInAuthApi extends LoginProviderAuthBase {
    /**
     * @Injectable
     * @var \AUTH\Services\LinkedInService
     */
    protected $srv;

    /**
     * @label Solicitar login mediante Google Sign In
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
        return $this->authenticate($this->getRequest()->getQueryParams(), LinkedInService::FLOW_LOGIN);
    }

    /**
     * @label Solicitar registro mediane Google Sign In
     * @GET
     * @route /register/{__API__}
     * @return \PSFS\base\dto\JsonResponse(data={__API__})
     */
    public function requestRegistration() {
        Request::getInstance()->redirect($this->srv->getAuthUrl(LinkedInService::FLOW_REGISTER));
    }

    /**
     * @label Callback del flujo OAuth para el registro
     * @GET
     * @route /register/{__API__}/callback
     * @return \PSFS\base\dto\JsonResponse(data={__API__})
     */
    public function registerCallback() {
        return $this->authenticate($this->getRequest()->getQueryParams(), LinkedInService::FLOW_REGISTER);
    }
}