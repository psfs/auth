<?php
namespace AUTH\Api\base;

use \PSFS\base\types\AuthApi;
use AUTH\Models\Map\LoginAccountTableMap;

/**
* Class AUTHBaseApi
* @package AUTH\Api\base
* @author Fran López <fran.lopez84@hotmail.es>
* @version 1.0
* Autogenerated controller [2023-06-14 23:43:03]
*/
abstract class LoginAccountBaseApi extends AuthApi{
    public function getModelTableMap()
    {
        return LoginAccountTableMap::class;
    }
}
