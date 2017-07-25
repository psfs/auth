<?php
namespace AUTH\Types;

use AUTH\Models\LoginSessionQuery;
use AUTH\Types\Interfaces\SessionAuthInterface;
use PSFS\base\config\Config;
use PSFS\base\dto\JsonResponse;
use PSFS\base\types\AuthController;

/**
 * Class SessionAuthController
 * @package AUTH\Types
 */
abstract class SessionAuthController extends AuthController implements SessionAuthInterface {

    use SessionAuthTrait;

    public function init()
    {
        parent::init();
        $this->checkAuth();
    }

    /**
     * @return string
     */
    public function checkAuth()
    {
        if (!$this->security->isAdmin()) {
            if(!$this->public && Config::getParam('psfs.auth.enable')) {
                $token = self::getBearerToken();
                if (empty($token)) {
                    return $this->json(new JsonResponse(_('Not authorized, missing Api Token in the request'), false), 412);
                }
                $session = LoginSessionQuery::checkToken($token);
                if (!$session) {
                    return $this->json(new JsonResponse(_('Not authorized, token not valid'), false), 401);
                } else {
                    $this->account = $session->getAccountSession();
                }
            }
        }
    }
}