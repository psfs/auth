<?php
namespace AUTH\Services;

use AUTH\Dto\AuthUserDto;
use AUTH\Exception\InvalidCallbackParametersException;
use AUTH\Exception\ProviderOauthFlowException;
use AUTH\Models\Map\LoginProviderTableMap;
use AUTH\Services\base\AUTHService;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Facebook\FacebookResponse;
use Facebook\PersistentData\FacebookSessionPersistentDataHandler;
use PSFS\base\exception\GeneratorException;
use PSFS\base\Router;

/**
 * Class OfficeService
 * @package AUTH\Services
 */
class OfficeService extends AUTHService {
    /**
     * @return string
     */
    public function getProviderName()
    {
        return LoginProviderTableMap::COL_NAME_LIVE;
    }

    /**
     * @return array
     */
    public function getProviderDefaultScopes() {
        return [
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
            $redirectUri .= Router::getInstance()->getRoute('auth-office-callback');
        } else {
            $redirectUri .= Router::getInstance()->getRoute('register-office-callback');
        }
        return $redirectUri;
    }

    /**
     * @param int $flow
     * @return string
     * @throws FacebookSDKException
     */
    public function getAuthUrl($flow = self::FLOW_LOGIN)
    {
        $credentials = $this->getClient(null);
        return "https://login.microsoftonline.com/common/oauth2/v2.0/authorize?client_id={$credentials['app_id']}&response_type=id_token&redirect_uri=http%3A%2F%2Flocalhost%2Fmyapp%2F&scope=openid&response_mode=fragment&state=12345&nonce=678910";
    }

    /**
     * @param array $query
     * @param int $flow
     * @return AuthUserDto|null
     * @throws FacebookSDKException
     * @throws GeneratorException
     * @throws InvalidCallbackParametersException
     * @throws ProviderOauthFlowException
     */
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

    /**
     * @param array $auth
     * @param int $flow
     * @return AuthUserDto|null
     * @throws FacebookSDKException
     * @throws GeneratorException
     */
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
     * @param int $flow
     * @return Facebook|mixed
     * @throws FacebookSDKException
     */
    public function getClient($callbackUri, $flow = self::FLOW_LOGIN)
    {
        if(null === self::$client) {
            self::$client = [
                'app_id' => $this->provider->getClient(),
                'app_secret' => $this->provider->getSecret(),
            ];
        }

        return self::$client;
    }
}