<?php

namespace AUTH\Models;

use AUTH\Models\Base\LoginSessionQuery as BaseLoginSessionQuery;

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
     * @return LoginSession
     */
    public static function checkToken($token) {
        return self::create()
            ->filterByActive(true)
            ->filterByToken($token)
            ->useAccountSessionQuery()
                ->filterByActive(true)
                ->useAccountProviderQuery()
                    ->filterByActive(true)
                ->endUse()
            ->endUse()
            ->findOne();
    }
}
