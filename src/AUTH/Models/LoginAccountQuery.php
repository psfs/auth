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
     * @return LoginAccount
     */
    public static function getAccountByIdentifier($identifier, LoginProvider $provider) {
        return self::create()
            ->filterById($identifier)
            ->filterByActive(true)
            ->filterByIdSocial($provider->getPrimaryKey())
            ->findOneOrCreate();
    }
}
