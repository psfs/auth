<?php
namespace AUTH\Api\base;

use PSFS\base\types\AuthApi;
use AUTH\Models\Map\LoginProviderTableMap;

/**
* Class AUTHBaseApi
* @package AUTH\Api\base
* @author Fran López <fran.lopez84@hotmail.es>
* @version 1.0
* Autogenerated controller [2019-10-22 00:26:47]
*/
abstract class LoginProviderBaseApi extends AuthApi{
    public function getModelTableMap()
    {
        return LoginProviderTableMap::class;
    }
}