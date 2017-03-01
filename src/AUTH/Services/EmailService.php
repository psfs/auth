<?php
namespace AUTH\Services;

use AUTH\Models\Map\LoginProviderTableMap;
use AUTH\Services\base\AUTHService;

class EmailService extends AUTHService
{
    /**
     * @inheritDoc
     */
    public function getProviderName()
    {
        return LoginProviderTableMap::COL_NAME_EMAIL;
    }

    /**
     * Not used
     * @inheritDoc
     */
    public function getClient($callbackUri, $flow = self::FLOW_LOGIN)
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getAuthUrl($flow = self::FLOW_LOGIN)
    {
        // TODO: Implement getAuthUrl() method.
    }

    /**
     * @inheritDoc
     */
    public function authenticate(array $query, $flow = self::FLOW_LOGIN)
    {
        // TODO: Implement authenticate() method.
    }

    /**
     * @inheritDoc
     */
    public function getUser(array $auth, $flow = self::FLOW_LOGIN)
    {
        // TODO: Implement getUser() method.
    }
}