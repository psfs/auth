<?php

namespace AUTH\Models;

use AUTH\Models\Base\LoginSessionQuery as BaseLoginSessionQuery;
use AUTH\Models\Map\LoginSessionTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Propel;
use PSFS\base\config\Config;

/**
 * Skeleton subclass for performing query and update operations on the 'AUTH_SESSIONS' table.
 *
 * Table with the login session token
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class LoginSessionQuery extends BaseLoginSessionQuery
{
    /**
     * @param string $token
     * @param string $customer
     * @return LoginSession
     */
    public static function checkToken($token, $customer = 'psfs') {
        $con = Propel::getReadConnection(LoginSessionTableMap::DATABASE_NAME);
        $con->useDebug(Config::getParam('debug'));
        $session = self::create()
            ->filterByActive(true)
            ->filterByToken($token)
            ->useAccountSessionQuery()
                ->filterByActive(true)
                ->useAccountProviderQuery()
                    ->filterByCustomerCode($customer)
                    ->filterByActive(true)
                ->endUse()
            ->endUse()
            ->findOne($con);
        return $session;
    }

    /**
     * @param LoginAccount $account
     * @return LoginSession
     */
    public static function getLastSession(LoginAccount $account) {
        return self::create()
            ->filterByIdAccount($account->getPrimaryKey())
            ->filterByActive(true)
            ->orderByUpdatedAt(Criteria::DESC)
            ->findOneOrCreate();
    }
}
