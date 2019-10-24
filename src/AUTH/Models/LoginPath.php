<?php

namespace AUTH\Models;

use AUTH\Models\Base\LoginPath as BaseLoginPath;

/**
 * Skeleton subclass for representing a row from the 'AUTH_PATHS' table.
 *
 * Customer provider paths to redirect
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class LoginPath extends BaseLoginPath
{
    const PATH_BASE = 'login.base';
    const PATH_LOGIN = 'login.action';
    const PATH_LOGIN_CANCEL = 'login.cancel';
    const PATH_REGISTER = '';
    const PATH_REGISTER_CANCEL = '';
    const PATH_LOGOUT = '';
}
