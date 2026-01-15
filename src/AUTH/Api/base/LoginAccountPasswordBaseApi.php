<?php
namespace AUTH\Api\base;

use PSFS\base\types\AuthApi;
use AUTH\Models\Map\LoginAccountPasswordTableMap;

/**
* Class AUTHBaseApi
* @package AUTH\Api\base
* @version 1.0
*/
abstract class LoginAccountPasswordBaseApi extends AuthApi{
    public function getModelTableMap()
    {
        return LoginAccountPasswordTableMap::class;
    }
}
