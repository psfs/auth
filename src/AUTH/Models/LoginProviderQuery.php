<?php

namespace AUTH\Models;

use AUTH\Models\Base\LoginProviderQuery as BaseLoginProviderQuery;

/**
 * Skeleton subclass for performing query and update operations on the 'AUTH_PROVIDERS' table.
 *
 * Table with the login providers
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class LoginProviderQuery extends BaseLoginProviderQuery
{
    /**
     * @param $providerName
     * @param bool $devMode
     * @return LoginProvider
     */
    public static function getProvider($providerName, $devMode = true) {
        return self::create()
            ->filterByName($providerName)
            ->filterByDebug($devMode)
            ->findOne();
    }
}
