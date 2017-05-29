<?php
namespace AUTH\Services;

use Abraham\TwitterOAuth\TwitterOAuth;
use AUTH\Dto\AuthUserDto;
use AUTH\Exception\InvalidCallbackParametersException;
use AUTH\Models\Map\LoginProviderTableMap;
use AUTH\Services\base\AUTHService;
use PSFS\base\Router;
use PSFS\base\Security;

/**
 * Class TwitterService
 * @package AUTH\Services
 */
class TwitterService extends AUTHService {

    /**
     * @return string
     */
    public function getProviderName()
    {
        return LoginProviderTableMap::COL_NAME_TWITTER;
    }

    /**
     * @param string $callbackUri
     * @param integer $flow
     * @return TwitterOAuth
     */
    public function getClient($callbackUri, $flow = self::FLOW_LOGIN)
    {
        if(null === self::$client) {
            self::$client = new TwitterOAuth($this->provider->getClient(), $this->provider->getSecret());
        }

        return self::$client;
    }

    /**
     * @param integer $flow
     * @return string
     */
    public function getAuthUrl($flow = self::FLOW_LOGIN)
    {
        $client = $this->getClient(null, $flow);
        $auth = $client->oauth('oauth/request_token');
        Security::getInstance()->setSessionKey('TWITTER_FLOW', $flow);
        Security::getInstance()->setSessionKey('TWITTER_FLOW_AUTH', $auth);
        $slug = ($flow === self::FLOW_LOGIN) ? 'auth-twitter-callback' : 'register-twitter-callback';
        return $client->url('oauth/' . $flow, [
            'oauth_token' => $auth['oauth_token'],
            'include_email' => true,
            //'oauth_callback' => Router::getInstance()->getRoute($slug, true),
        ]);
    }

    /**
     * @param array $query
     * @param  integer $flow
     * @return AuthUserDto|null
     * @throws InvalidCallbackParametersException
     */
    public function authenticate(array $query, $flow = self::FLOW_LOGIN)
    {
        // TODO: Implement authenticate() method.
    }

    /**
     * @param array $auth
     * @param integer $flow
     * @return AuthUserDto|null
     */
    public function getUser(array $auth, $flow = self::FLOW_LOGIN)
    {
        // TODO: Implement getUser() method.
    }
}