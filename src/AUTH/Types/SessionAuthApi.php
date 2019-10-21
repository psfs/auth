<?php
namespace AUTH\Types;

use AUTH\Models\LoginSessionQuery;
use AUTH\Models\Map\LoginAccountTableMap;
use AUTH\Types\Base\SessionAuthInterface;
use PSFS\base\config\Config;
use PSFS\base\dto\JsonResponse;
use PSFS\base\Security;
use PSFS\base\types\Api;
use PSFS\base\types\helpers\Inspector;

/**
 * Class SessionAuthApi
 * @package AUTH\Type
 */
abstract class SessionAuthApi extends Api implements SessionAuthInterface
{
    use SessionAuthTrait;

    /**
     * @throws \PSFS\base\exception\GeneratorException
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function init()
    {
        Inspector::stats('[init] Start SessionAuthApi verification');
        Security::getInstance()->checkAdmin(null, null, true);
        parent::init();
        Inspector::stats('[init] Start checkAuth');
        $this->checkAuth();
        Inspector::stats('[init] End SessionAuthApi verification');
    }

    /**
     * @return string
     * @throws \PSFS\base\exception\GeneratorException
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function checkAuth()
    {
        if(!$this->public && Config::getParam('psfs.auth.enable')) {
            $token = self::getBearerToken();
            if (empty($token) && !$this->security->isAdmin()) {
                return $this->json(new JsonResponse(t('Not authorized, missing Api Token in the request'), false), 412);
            } else {
                $session = LoginSessionQuery::checkToken($token);
                if (!$session && !$this->security->isAdmin()) {
                    return $this->json(new JsonResponse(t('Not authorized, token not valid'), false), 401);
                } elseif(null !== $session) {
                    $this->account = $session->getAccountSession();
                    if($this->account->getAccountRole() !== LoginAccountTableMap::COL_ROLE_USER) {
                        $profile = null;
                        switch($this->account->getAccountRole())
                        {
                            case LoginAccountTableMap::COL_ROLE_MANAGER:
                                $profile = Security::MANAGER_ID_TOKEN;
                                break;
                            case LoginAccountTableMap::COL_ROLE_ADMIN:
                                $profile = Security::ADMIN_ID_TOKEN;
                                break;
                        }
                        Security::getInstance()->updateAdmin($this->account->getEmail(), $profile);
                    }
                } elseif(!$this->security->isAdmin()) {
                    return $this->json(new JsonResponse(t('Not authorized, restricted zone'), false), 412);
                }
            }

        }
    }

}