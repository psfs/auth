<?php
namespace AUTH\Api;

use AUTH\Api\base\LoginProviderAuthBase;
use AUTH\Services\EmailService;
use PSFS\base\dto\JsonResponse;
use PSFS\base\Logger;
use PSFS\base\Security;

/**
 * Class EmailAuthApi
 * @package AUTH\Api
 */
class EmailAuthApi extends LoginProviderAuthBase {
    /**
     * @Injectable
     * @var \AUTH\Services\EmailService
     */
    protected $srv;

    /**
     * @param array $query
     * @param int $flow
     * @return mixed
     * @throws \Exception
     */
    protected function authenticate(array $query, $flow)
    {
        try {
            $user = $this->srv->authenticate($query, $flow);
        } catch (\Exception $e) {
            Logger::log($e->getMessage(), LOG_ERR);
            throw $e;
        }
        return $user;
    }

    /**
     * @label Registra a un usuario por email
     * @POST
     * @route /register/email
     * @return \PSFS\base\dto\JsonResponse(data={__API__})
     */
    public function register() {
        return $this->login(EmailService::FLOW_REGISTER);
    }

    /**
     * @label Hace login de un usuario por email
     * @POST
     * @param integer $flow
     * @route /auth/email
     * @return \PSFS\base\dto\JsonResponse(data=\AUTH\Dto\AuthUserDto)
     */
    public function login($flow = EmailService::FLOW_LOGIN) {
        $success = true;
        try {
            $user = $this->authenticate($this->getRequest()->getData(), $flow);
            Security::getInstance()->updateUser(serialize($user));
        } catch(\Exception $e) {
            $success = false;
            $user = $e->getMessage();
        }
        return $this->json(new JsonResponse($user, $success), $success ? 200 : 400);
    }

    /**
     * @label Resetea la contraseña de un usuario
     * @POST
     * @route /auth/password/reset
     * @return \PSFS\base\dto\JsonResponse(data=string)
     */
    public function resetPassword() {
        $data = $this->getRequest()->getData();
        $code = 200;
        try {
            $reset = $this->auth->resetPassword($data);
        } catch(\Exception $e) {
            $reset = false;
            $code = $e->getCode();
        }
        return $this->json(new JsonResponse($reset, $reset), $code);
    }
}