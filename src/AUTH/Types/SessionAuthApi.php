<?php
namespace AUTH\Types;

use AUTH\Models\LoginSessionQuery;
use AUTH\Models\Map\LoginAccountTableMap;
use AUTH\Types\Base\SessionAuthInterface;
use PSFS\base\config\Config;
use PSFS\base\dto\JsonResponse;
use PSFS\base\Logger;
use PSFS\base\Security;
use PSFS\base\types\Api;

/**
 * Class SessionAuthApi
 * @package AUTH\Type
 */
abstract class SessionAuthApi extends Api implements SessionAuthInterface
{
    use SessionAuthTrait;

    public function init()
    {
        Security::getInstance()->checkAdmin(null, null, true);
        parent::init();
        $this->checkAuth();
    }

    /**
     * @return string
     */
    public function checkAuth()
    {
        if(!$this->public && Config::getParam('psfs.auth.enable')) {
            $token = self::getBearerToken();
            if (empty($token) && !$this->security->isAdmin()) {
                return $this->json(new JsonResponse(_('Not authorized, missing Api Token in the request'), false), 412);
            } else {
                $session = LoginSessionQuery::checkToken($token);
                if (!$session && !$this->security->isAdmin()) {
                    return $this->json(new JsonResponse(_('Not authorized, token not valid'), false), 401);
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
                    return $this->json(new JsonResponse(_('Not authorized, restricted zone'), false), 412);
                }
            }

        }
    }

    protected function hydrateModel($pk)
    {
        try {
            $query = $this->prepareQuery();
            $this->addFilters($query);
            $this->checkReturnFields($query);
            $query->filterByPrimaryKey($pk);
            $this->model = $this->findPk($query, null);
        } catch (\Exception $e) {
            Logger::log(get_class($this) . ': ' . $e->getMessage(), LOG_ERR);
        }
    }
}