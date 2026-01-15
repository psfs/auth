<?php
namespace AUTH\Api\base;

use PSFS\base\types\AuthApi;
use AUTH\Models\Map\LoginPathTableMap;

/**
* Class AUTHBaseApi
* @package AUTH\Api\base
* @version 1.0
*/
abstract class LoginPathBaseApi extends AuthApi{
    public function getModelTableMap()
    {
        return LoginPathTableMap::class;
    }
}
