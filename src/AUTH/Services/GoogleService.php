<?php
namespace AUTH\Services;

use AUTH\Dto\AuthUserDto;
use AUTH\Exception\InvalidCallbackParametersException;
use AUTH\Models\Map\LoginProviderTableMap;
use PSFS\base\config\Config;
use PSFS\base\Router;

/**
 * Class GoogleService
 * @package AUTH\Services
 */
class GoogleService extends AUTHService {
    /**
     * @return string
     */
    public function getProviderName()
    {
        return LoginProviderTableMap::COL_NAME_GOOGLE;
    }

    /**
     * @return array
     */
    public function getScopes() {
        return (count($this->scopes)) ? $this->scopes : [
            \Google_Service_Plus::PLUS_LOGIN,
            \Google_Service_Plus::PLUS_ME,
            \Google_Service_Plus::USERINFO_EMAIL,
            \Google_Service_Plus::USERINFO_PROFILE,
        ];
    }

    public function getAuthUrl($flow = self::FLOW_LOGIN)
    {
        $client = $this->getClient(Router::getInstance()->getRoute('auth-google-callback', true), $flow);
        return $client->createAuthUrl();
    }

    public function authenticate(array $query, $flow = self::FLOW_LOGIN)
    {
        if(!array_key_exists('code', $query)) {
            throw new InvalidCallbackParametersException();
        }
        $client = $this->getClient(Router::getInstance()->getRoute('auth-google-callback', true), $flow);
        $token = $client->fetchAccessTokenWithAuthCode($query['code']);
        return $this->getUser($token);
    }

    public function getUser(array $auth, $flow = self::FLOW_LOGIN)
    {
        $client = $this->getClient(Router::getInstance()->getRoute('auth-google-callback', true), $flow);
        $client->setAccessToken($auth);
        $googlePlus = new \Google_Service_Plus($client);
        $profile = $googlePlus->people->get('me');
        $user = new AuthUserDto();
        $user->id = $profile->getId();
        $user->name = $profile->getDisplayName();
        $user->photo = array_shift(explode('?', $profile->getImage()->getUrl()));
        $user->access_token = $auth['access_token'];
        $user->expires = new \DateTime();
        $user->expires->modify($auth['expires_in'] . ' seconds');
        if(array_key_exists('refresh_token', $auth)) {
            $user->refresh_token = $auth['refresh_token'];
        }
        /** @var \Google_Service_Plus_PersonEmails $email */
        foreach($profile->getEmails() as $email) {
            if($email->getType() == 'account') {
                $user->email = $email->getValue();
                break;
            }
        }
        $user->raw = $profile->toSimpleObject();
        $user->hydrate($this->provider);
        return $user;
    }

    /**
     * @param string $callbackUri
     * @param integer $flow
     * @return \Google_Client
     */
    public function getClient($callbackUri, $flow = self::FLOW_LOGIN)
    {
        if(null === self::$client) {
            $config = [
                'client_id' => $this->provider->getClient(),
                'client_secret' => $this->provider->getSecret(),
                'redirect_uri' => $callbackUri,
            ];
            if(self::FLOW_REGISTER === $flow) {
                $config['approval_prompt'] = Config::getParam('google.prompt', false);
            }
            self::$client = new \Google_Client($config);
            self::$client->setAccessType(Config::getParam('google.accessType', 'offline'));
            self::$client->setScopes($this->getScopes());
        }

        return self::$client;
    }
}