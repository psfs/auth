<?php
namespace AUTH\Api;

use AUTH\Api\base\LoginAccountBaseApi;
use AUTH\Models\LoginAccountQuery;
use AUTH\Models\Map\LoginAccountTableMap;
use AUTH\Models\Map\LoginProviderTableMap;
use AUTH\Services\AUTHService;
use AUTH\Services\EmailService;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use PSFS\base\dto\JsonResponse;

/**
* Class AUTH
* @package AUTH\Api
* @author Fran López <fran.lopez84@hotmail.es>
* @version 1.0
* @Api LoginAccount
* @visible false
* Autogenerated controller [2017-02-20 00:39:30]
*/
class LoginAccount extends LoginAccountBaseApi
{
    public $public = true;
    public function init()
    {
        parent::init();
        $this->extraColumns = [
            'CONCAT(' . LoginProvider::getListNameSql() . ', " ", IFNULL(' . LoginAccountTableMap::COL_EMAIL . ', ' . LoginAccountTableMap::COL_IDENTIFIER . '))' => self::API_LIST_NAME_FIELD,
        ];
    }

    public function joinTables(ModelCriteria &$query)
    {
        /** @var LoginAccountQuery $query */
        $query
            ->useAccountProviderQuery()->endUse()
        ;
    }

    /**
     * @POST
     * @route /{__DOMAIN__}/{__API__}/{IdAccount}/reset
     * @label Solicitar reset de la cuenta
     * @action true
     * @param integer $IdAccount
     * @return \PSFS\base\dto\JsonResponse(data=boolean)
     */
    public function requestResetPassword($IdAccount) {
        /** @var \AUTH\Models\LoginAccount $account */
        $account = self::_get($IdAccount);
        $requested = false;
        if(null !== $account && $account->getAccountProvider()->getName() === LoginProviderTableMap::COL_NAME_EMAIL) {
            $requested = EmailService::getInstance()->resetAccount($account);
        }
        return $this->json(new JsonResponse($requested, $requested), $requested ? 200 : 400);
    }

    /**
     * @GET
     * @route /{__DOMAIN__}/{__API__}/{IdAccount}/logout/{token}
     * @label Logout sesión activa
     * @action true
     * @param integer $IdAccount
     * @param string $token
     * @return \PSFS\base\dto\JsonResponse(data=boolean)
     */
    public function logout($IdAccount, $token) {
        /** @var \AUTH\Models\LoginAccount $account */
        $account = self::_get($IdAccount);
        $loggedOut = EmailService::getInstance()->logoutSession($account, $token);
        return $this->json(new JsonResponse($loggedOut, $loggedOut), $loggedOut ? 200 : 400);
    }

}