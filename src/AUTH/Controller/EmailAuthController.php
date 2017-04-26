<?php
namespace AUTH\Controller;

use AUTH\Services\EmailService;
use PSFS\base\dto\JsonResponse;
use PSFS\base\Logger;
use PSFS\base\Security;

class EmailAuthController extends AUTHController {

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
     * @POST
     * @route /register/email
     */
    public function register() {
        return $this->login(EmailService::FLOW_REGISTER);
    }

    /**
     * @POST
     * @param integer $flow
     * @route /auth/email
     * @return string JSON
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

}