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
        $oauthUrl = ($flow === self::FLOW_LOGIN) ? 'authenticate' : 'authorize';
        return $client->url('oauth/' . $oauthUrl, [
            'oauth_token' => $auth['oauth_token'],
            'include_email' => true,
            'oauth_callback' => Router::getInstance()->getRoute($slug, true),
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
        $client = $this->getClient(null, $flow);
        $auth = Security::getInstance()->getSessionKey('TWITTER_FLOW_AUTH');
        $client->setOauthToken($auth['oauth_token'], $auth['oauth_token_secret']);
        $credentials = $client->oauth("oauth/access_token", ["oauth_verifier" => $query['oauth_verifier'], 'include_email' => true]);
        return $this->getUser($credentials, $flow);
    }

    /**
     * @param array $auth
     * @param integer $flow
     * @return AuthUserDto|null
     */
    public function getUser(array $auth, $flow = self::FLOW_LOGIN)
    {
        $profile = new AuthUserDto();
        $profile->id = $auth['user_id'];
        $profile->access_token = $auth['oauth_token'];
        $profile->refresh_token = $auth['oauth_token_secret'];

        $client = $this->getClient(null, $flow);
        $client->setOauthToken($profile->access_token, $profile->refresh_token);
        $user = $client->get("account/verify_credentials", ['include_email' => true , 'skip_status' => true]);

        $profile->name = $user->name;
        $profile->photo = $user->profile_image_url_https;
        $profile->email = (property_exists($user, 'email')) ? $user->email : $user->screen_name . '@twitter.com';
        Security::getInstance()->setSessionKey('TWITTER_FLOW', null);
        Security::getInstance()->setSessionKey('TWITTER_FLOW_AUTH', null);
        $profile->raw = $user;
        $profile->hydrate($this->provider);
        return $profile;
    }
}