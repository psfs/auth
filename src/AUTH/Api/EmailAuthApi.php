<?php
namespace AUTH\Api;

use AUTH\Api\base\LoginProviderAuthBase;
use AUTH\Models\LoginAccountQuery;
use AUTH\Models\LoginSessionQuery;
use AUTH\Services\base\AUTHService;
use AUTH\Services\EmailService;
use PSFS\base\dto\JsonResponse;
use PSFS\base\exception\ApiException;
use PSFS\base\Logger;
use PSFS\base\Request;
use PSFS\base\Security;

/**
 * Class EmailAuthApi
 * @package AUTH\Api
 * @Api Email
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
     * @route /{__DOMAIN__}/Api/register/{__API__}
     * @payload \AUTH\Dto\RegisterDto
     * @return \PSFS\base\dto\JsonResponse(data={__API__})
     */
    public function register() {
        return $this->login(EmailService::FLOW_REGISTER);
    }

    /**
     * @label Hace login de un usuario por email
     * @POST
     * @param integer $flow
     * @route /{__DOMAIN__}/Api/auth/{__API__}
     * @return \PSFS\base\dto\JsonResponse(data=\AUTH\Dto\AuthUserDto)
     */
    public function login($flow = EmailService::FLOW_LOGIN) {
        $success = true;
        $code = 200;
        try {
            $user = $this->authenticate($this->getRequest()->getData(), $flow);
            Security::getInstance()->updateUser(serialize($user));
        } catch(\Exception $e) {
            $success = false;
            $user = $e->getMessage();
            $code = $e->getCode();
        }
        return $this->json(new JsonResponse($user, $success), $code);
    }

    /**
     * @label Resetea la contraseña de un usuario
     * @POST
     * @route /{__DOMAIN__}/Api/auth/password/reset
     * @return \PSFS\base\dto\JsonResponse(data=string)
     */
    public function resetPassword() {
        $data = $this->getRequest()->getData();
        $code = 200;
        try {
            $reset = $this->srv->resetPassword($data);
        } catch(\Exception $e) {
            $reset = false;
            $code = $e->getCode();
        }
        return $this->json(new JsonResponse($reset, $reset), $code);
    }

    /**
     * @GET
     * @route /{__DOMAIN__}/Api/verify/{userToken}
     * @param string $userToken
     * @return \PSFS\base\dto\JsonResponse(data=bool)
     * @throws ApiException
     * @throws \PSFS\base\exception\GeneratorException
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function verify($userToken) {
        $user = LoginAccountQuery::getUserByToken($userToken, $this->customer);
        if(null === $user) {
            throw new ApiException(t('User not found'));
        }
        $user->setVerified(true);
        $success = false !== $user->save($this->con);
        return $this->json(new JsonResponse($success, $success), $success ? 200 : 400);
    }

    /**
     * @POST
     * @route /{__DOMAIN__}/Api/handshake/{token}
     * @param string $token
     * @return \PSFS\base\dto\JsonResponse(data=string)
     */
    public function handshake($token) {
        $session = LoginSessionQuery::checkToken($token, $this->customer);
        return $this->json(new JsonResponse($token, null !== $session), null !== $session ? 200 : 401);
    }

    /**
     * @DELETE
     * @route /{__DOMAIN__}/Api/logout/{token}
     * @param string $token
     * @return \PSFS\base\dto\JsonResponse(data=string)
     */
    public function logout($token) {
        $session = LoginSessionQuery::checkToken($token, $this->customer);
        if(null !== $session) {
            $logout = false !== $session->setActive(false)
                    ->save($this->con);
        } else {
            $logout = false;
        }
        return $this->json(new JsonResponse($logout, $logout), 200);
    }
}