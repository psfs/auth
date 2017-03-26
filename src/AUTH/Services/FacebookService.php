<?php
namespace AUTH\Services;

use AUTH\Dto\AuthUserDto;
use AUTH\Exception\InvalidCallbackParametersException;
use AUTH\Exception\ProviderOauthFlowException;
use AUTH\Models\Map\LoginProviderTableMap;
use AUTH\Services\base\AUTHService;
use Facebook\Facebook;
use Facebook\FacebookResponse;
use Facebook\PersistentData\FacebookSessionPersistentDataHandler;
use PSFS\base\config\Config;
use PSFS\base\Router;

/**
 * Class FacebookService
 * @package AUTH\Services
 */
class FacebookService extends AUTHService {
    /**
     * @return string
     */
    public function getProviderName()
    {
        return LoginProviderTableMap::COL_NAME_FACEBOOK;
    }

    /**
     * @return array
     */
    public function getScopes() {
        return (count($this->scopes)) ? $this->scopes : [
            'email', 'user_birthday'
        ];
    }

    /**
     * @param int $flow
     * @return string
     */
    private function getRedirectUri($flow = self::FLOW_LOGIN) {

        $redirectUri = $this->base;
        if(self::FLOW_LOGIN === $flow) {
            $redirectUri .= Router::getInstance()->getRoute('auth-facebook-callback');
        } else {
            $redirectUri .= Router::getInstance()->getRoute('register-facebook-callback');
        }
        return $redirectUri;
    }

    public function getAuthUrl($flow = self::FLOW_LOGIN)
    {
        $client = $this->getClient(null, $flow);
        $helper = $client->getRedirectLoginHelper();
        return $helper->getLoginUrl($this->getRedirectUri($flow), $this->getScopes());
    }

    public function authenticate(array $query, $flow = self::FLOW_LOGIN)
    {
        if(array_key_exists('error', $query)) {
            throw new ProviderOauthFlowException($query['error_description'], 401);
        }
        if(!array_key_exists('code', $query)) {
            throw new InvalidCallbackParametersException();
        }
        $facebookClient = $this->getClient(null, $flow);
        $helper = $facebookClient->getRedirectLoginHelper();
        $sessionHandler = new FacebookSessionPersistentDataHandler();
        $sessionHandler->set('state', $query['state']);
        $accessToken = $helper->getAccessToken($this->getRedirectUri($flow));
        if (isset($accessToken) && !$accessToken->isLongLived()) {
            // The OAuth 2.0 client handler helps us manage access tokens
            $oAuth2Client = $facebookClient->getOAuth2Client();
            $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
        } elseif ($helper->getError()) {
            throw new ProviderOauthFlowException($helper->getErrorReason(), 500);
        }
        return $this->getUser([
            "access_token" => $accessToken->getValue(),
            "expires" => $accessToken->getExpiresAt(),
        ], $flow);
    }

    public function getUser(array $auth, $flow = self::FLOW_LOGIN)
    {
        $client = $this->getClient(null, $flow);
        $responses = $client->sendBatchRequest([
            $client->request('get', '/me?fields=id,name,first_name,last_name,birthday,picture,email,gender', [], $auth['access_token']),
            $client->request('GET', '/me/picture', ['type' => 'large'], $auth['access_token']),
        ], $auth['access_token']);
        list($profile, $picture) = $responses->getResponses();
        /** @var FacebookResponse $profile */
        $profile = $profile->getDecodedBody();
        /** @var FacebookResponse $picture */
        $headers = $picture->getHeaders();
        $user = new AuthUserDto();
        $user->id = $profile['id'];
        $user->name = $profile['name'];
        $user->first_name = $profile['first_name'];
        $user->last_name = $profile['last_name'];
        $user->photo = $headers['Location'];
        $user->email = $profile['email'];
        $user->access_token = $auth['access_token'];
        $user->expires = $auth['expires'];
        $user->raw = $profile;
        $user->hydrate($this->provider);
        return $user;
    }

    /**
     * @param string $callbackUri
     * @param integer $flow
     * @return \Facebook\Facebook
     */
    public function getClient($callbackUri, $flow = self::FLOW_LOGIN)
    {
        if(null === self::$client) {
            $config = [
                'app_id' => $this->provider->getClient(),
                'app_secret' => $this->provider->getSecret(),
                'default_graph_version' => Config::getParam('facebook.version', 'v2.8'),
            ];
            self::$client = new Facebook($config);
        }

        return self::$client;
    }
}