<?php

namespace AUTH\Models;

use AUTH\Models\Base\LoginAccountPasswordQuery as BaseLoginAccountPasswordQuery;
use Propel\Runtime\ActiveQuery\Criteria;

/**
 * Skeleton subclass for performing query and update operations on the 'AUTH_ACCOUNT_PASSWORDS' table.
 *
 * Table with an history for account passwords
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class LoginAccountPasswordQuery extends BaseLoginAccountPasswordQuery
{
    /**
     * @param LoginAccount $account
     * @param $password
     * @return LoginAccountPassword
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public static function getSavedActivePassword(LoginAccount $account, $password) {
        $now = new \DateTime();
        return self::create()
            ->filterByIdAccount($account->getPrimaryKey())
            ->filterByValue($password)
            ->filterByExpirationDate($now, Criteria::GREATER_EQUAL)
            ->findOneOrCreate();
    }

    /**
     * @param LoginAccountPassword $password
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public static function deactivateOldPasswords(LoginAccountPassword $password) {
        $oldPasswords = self::create()
            ->filterByIdAccount($password->getIdAccount())
            ->filterByIdPassword($password->getPrimaryKey(), Criteria::NOT_EQUAL)
            ->find();
        $now = new \DateTime();
        $now->modify('-1 week');
        foreach($oldPasswords as $oldPassword) {
            $oldPassword->setExpirationDate($now)
                ->save();
        }
    }
}
