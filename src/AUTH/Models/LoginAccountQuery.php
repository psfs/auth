<?php

namespace AUTH\Models;

use AUTH\Models\Base\LoginAccountQuery as BaseLoginAccountQuery;

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
     * @return bool
     */
    public static function existsIdentifierForProvider($identifier, LoginProvider $provider) {
        return self::filterByIdentifierAndProvider($identifier, $provider)
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
}
