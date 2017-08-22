<?php
namespace AUTH\Api;

use AUTH\Api\base\LoginProviderAuthBase;
use AUTH\Services\GoogleService;
use PSFS\base\dto\JsonResponse;
use PSFS\base\Request;

class GoogleAuthApi extends LoginProviderAuthBase {
    /**
     * @Injectable
     * @var \AUTH\Services\GoogleService
     */
    protected $srv;

    /**
     * @label Solicitar login mediante Google Sign In
     * @GET
     * @route /auth/google
     * @return \PSFS\base\dto\JsonResponse(data={__API__})
     */
    public function requestLogin() {
        Request::getInstance()->redirect($this->srv->getAuthUrl());
    }

    /**
     * @label Callback del flujo OAuth para el login
     * @GET
     * @route /auth/google/callback
     * @return \PSFS\base\dto\JsonResponse(data={__API__})
     */
    public function loginCallback() {
        return $this->authenticate($this->getRequest()->getQueryParams(), GoogleService::FLOW_REGISTER);
    }

    /**
     * @label Solicitar registro mediane Google Sign In
     * @GET
     * @route /register/google
     * @return \PSFS\base\dto\JsonResponse(data={__API__})
     */
    public function requestRegistration() {
        Request::getInstance()->redirect($this->srv->getAuthUrl(GoogleService::FLOW_REGISTER));
    }

    /**
     * @label Callback del flujo OAuth para el registro
     * @GET
     * @route /register/google/callback
     * @return \PSFS\base\dto\JsonResponse(data={__API__})
     */
    public function registerCallback() {
        return $this->authenticate($this->getRequest()->getQueryParams(), GoogleService::FLOW_REGISTER);
    }

    /**
     * @label Servicio que comprueba el Id Token de un usuario
     * @post
     * @route /auth/google/check/{idToken}
     * @param string $idToken
     * @return \PSFS\base\dto\JsonResponse(data=\AUTH\Dto\GoogleCheckDto)
     */
    public function checkIdToken($idToken) {
        $message = null;
        $success = true;
        try {
            $response = $this->srv->verifyIdToken($idToken);
        } catch(\Exception $e) {
            $response = null;
            $message = $e->getMessage();
            $success = false;
        }
        return $this->json(new JsonResponse($response, $success, 1, 1, $message), 200);
    }
}