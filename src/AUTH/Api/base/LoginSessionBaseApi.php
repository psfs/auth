<?php
namespace AUTH\Api\base;

use PSFS\base\types\AuthApi;
use AUTH\Models\Map\LoginSessionTableMap;

/**
* Class AUTHBaseApi
* @package AUTH\Api\base
* @version 1.0
*/
abstract class LoginSessionBaseApi extends AuthApi{
    public function getModelTableMap()
    {
        return LoginSessionTableMap::class;
    }
}
