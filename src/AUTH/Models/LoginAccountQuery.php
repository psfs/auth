<?php

namespace AUTH\Models;

use AUTH\Models\Base\LoginAccountQuery as BaseLoginAccountQuery;
use AUTH\Models\Map\LoginProviderTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use PSFS\base\config\Config;

/**
 * Skeleton subclass for performing query and update operations on the 'AUTH_ACCOUNTS' table.
 *
 * Table with the login accounts
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class LoginAccountQuery extends BaseLoginAccountQuery
{
    /**
     * @param $identifier
     * @param LoginProvider $provider
     * @return $this|LoginAccountQuery
     */
    private function filterByIdentifierAndProvider($identifier, LoginProvider $provider) {
        return self::create()
            ->filterById($identifier)
            ->filterByActive(true)
            ->filterByIdSocial($provider->getPrimaryKey());
    }

    /**
     * @param $identifier
     * @param LoginProvider $provider
     * @return LoginAccount
     */
    public static function getAccountByIdentifier($identifier, LoginProvider $provider) {
        return self::filterByIdentifierAndProvider($identifier, $provider)
            ->findOneOrCreate();
    }

    /**
     * @param $identifier
     * @param LoginProvider $provider
     * @param boolean $verified
     * @return bool
     */
    public static function existsIdentifierForProvider($identifier, LoginProvider $provider, $verified = true) {
        return self::filterByIdentifierAndProvider($identifier, $provider)
            ->filterByVerified($verified)
            ->count() > 0;
    }

    /**
     * @param $identifier
     * @param $password
     * @param LoginProvider $provider
     * @return bool
     */
    public static function existsIdentifierWithPassword($identifier, $password, LoginProvider $provider) {
        return self::filterByIdentifierAndProvider($identifier, $provider)
            ->filterByAccessToken($password)
            ->count() == 1;
    }

    /**
     * @param string $reset_token
     * @return LoginAccount
     */
    public static function getAccountForReset($reset_token) {
        return self::create()
            ->useAccountProviderQuery()
                ->filterByActive(true)
                ->filterByName(LoginProviderTableMap::COL_NAME_EMAIL)
                ->filterByDebug(Config::getParam('debug'))
            ->endUse()
            ->filterByResetToken($reset_token)
            ->filterByRefreshRequest(null, Criteria::ISNOTNULL)
            ->findOne();
    }

}
