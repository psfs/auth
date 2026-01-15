<?php
namespace AUTH\Api\base;

use PSFS\base\types\AuthApi;
use AUTH\Models\Map\LoginAccountTableMap;

/**
* Class AUTHBaseApi
* @package AUTH\Api\base
* @version 1.0
*/
abstract class LoginAccountBaseApi extends AuthApi{
    public function getModelTableMap()
    {
        return LoginAccountTableMap::class;
    }
}
