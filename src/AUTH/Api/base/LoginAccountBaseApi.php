<?php
namespace AUTH\Api\base;

use \AUTH\Types\SessionAuthApi;
use AUTH\Models\Map\LoginAccountTableMap;

/**
* Class AUTHBaseApi
* @package AUTH\Api\base
* @author Fran López <fran.lopez84@hotmail.es>
* @version 1.0
* Autogenerated controller [2017-04-26 13:39:05]
*/
abstract class LoginAccountBaseApi extends SessionAuthApi{
    public function getModelTableMap()
    {
        return LoginAccountTableMap::class;
    }
}