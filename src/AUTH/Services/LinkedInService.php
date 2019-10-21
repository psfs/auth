<?php
namespace AUTH\Services;

use AUTH\Dto\AuthUserDto;
use AUTH\Models\Map\LoginProviderTableMap;
use AUTH\Services\base\AUTHService;
use LinkedIn\LinkedIn;
use PSFS\base\exception\GeneratorException;
use PSFS\base\Router;

class LinkedInService extends AUTHService {
    /**
     * @return string
     */
    public function getProviderName()
    {
        return LoginProviderTableMap::COL_NAME_LINKEDIN;
    }

    /**
     * @param string $callbackUri
     * @param integer $flow
     * @return mixed
     */
    public function getClient($callbackUri, $flow = self::FLOW_LOGIN)
    {
        if(null === self::$client) {
            $oauth_url = ($flow === self::FLOW_LOGIN) ? 'auth-linkedin-callback' : 'register-linkedin-callback';
            self::$client = new LinkedIn([
                'api_key' => $this->provider->getClient(),
                'api_secret' => $this->provider->getSecret(),
                'callback_url' => $this->base . Router::getInstance()->getRoute($oauth_url),
            ]);
        }

        return self::$client;
    }

    /**
     * @param integer $flow
     * @return string
     */
    public function getAuthUrl($flow = self::FLOW_LOGIN)
    {
        return $this->getClient(null, $flow)->getLoginUrl([
            LinkedIn::SCOPE_BASIC_PROFILE,
            LinkedIn::SCOPE_EMAIL_ADDRESS,
        ]);
    }

    /**
     * @param array $query
     * @param int $flow
     * @return AuthUserDto|null
     * @throws GeneratorException
     */
    public function authenticate(array $query, $flow = self::FLOW_LOGIN)
    {
        $client = $this->getClient(null, $flow);
        $token = $client->getAccessToken($query['code']);
        $expires = $client->getAccessTokenExpiration();
        return $this->getUser([
            'access_token' => $token,
            'expiration' => $expires,
        ], $flow);
    }

    /**
     * @param array $auth
     * @param int $flow
     * @return AuthUserDto|null
     * @throws GeneratorException
     */
    public function getUser(array $auth, $flow = self::FLOW_LOGIN)
    {
        $client = $this->getClient(null, $flow);
        $client->setAccessToken($auth['access_token']);
        $linkedinProfile = $client->fetch('/people/~:(id,formatted-name,first-name,last-name,picture-url,email-address)?format=json', [], 'GET', [
            "Authorization: Bearer " . $auth['access_token'],
        ]);
        $profile = new AuthUserDto();
        $profile->id = $linkedinProfile['id'];
        $profile->name = $linkedinProfile['formattedName'];
        $profile->first_name = $linkedinProfile['firstName'];
        $profile->last_name= $linkedinProfile['lastName'];
        $profile->email = $linkedinProfile['emailAddress'];
        $profile->photo = $linkedinProfile['pictureUrl'];
        $profile->access_token = $auth['access_token'];
        $profile->refresh_token = $auth['access_token'];
        $profile->raw = $linkedinProfile;
        $profile->hydrate($this->provider);

        return $profile;
    }

}