<?php
namespace AUTH\Api\base;

use PSFS\base\types\AuthApi;
use AUTH\Models\Map\LoginProviderTableMap;

/**
* Class AUTHBaseApi
* @package AUTH\Api\base
* @version 1.0
*/
abstract class LoginProviderBaseApi extends AuthApi{
    public function getModelTableMap()
    {
        return LoginProviderTableMap::class;
    }
}
