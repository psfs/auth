<?php
namespace AUTH\Services;

use AUTH\Dto\AuthUserDto;
use AUTH\Exception\AuthApiAccessRestrictedException;
use AUTH\Exception\AuthProviderNotConfiguredException;
use AUTH\Exception\InvalidCallbackParametersException;
use AUTH\Models\LoginProviderQuery;
use PSFS\base\config\Config;
use PSFS\base\Logger;
use PSFS\base\Request;
use PSFS\base\Security;
use PSFS\base\Service;

/**
* Class AUTHService
* @package AUTH\Services
* @author Fran López <fran.lopez84@hotmail.es>
* @version 1.0
* Autogenerated service [2017-02-20 00:27:02]
*/
abstract class AUTHService extends Service {
    const FLOW_LOGIN = 1;
    const FLOW_REGISTER = 2;

    public static $client;
    /**
     * @var \AUTH\Models\LoginProvider
     */
    protected $provider;
    /**
     * @var boolean
     */
    protected $debug;
    /**
     * @var array
     */
    protected $scopes = [];

    /**
     * @return string
     */
    abstract public function getProviderName();

    /**
     * @param string $callbackUri
     * @param integer $flow
     * @return mixed
     */
    abstract public function getClient($callbackUri, $flow = self::FLOW_LOGIN);

    /**
     * @param integer $flow
     * @return string
     */
    abstract public function getAuthUrl($flow = self::FLOW_LOGIN);

    /**
     * @param array $query
     * @param  integer $flow
     * @return AuthUserDto|null
     * @throws InvalidCallbackParametersException
     */
    abstract public function authenticate(array $query, $flow = self::FLOW_LOGIN);

    /**
     * @param array $auth
     * @param integer $flow
     * @return AuthUserDto|null
     */
    abstract public function getUser(array $auth, $flow = self::FLOW_LOGIN);

    /**
     * @return array
     */
    public function getScopes() {
        return $this->scopes;
    }

    /**
     * @param array $scopes
     */
    public function setScopes(array $scopes) {
        $this->scopes = $scopes;
    }

    public function init()
    {
        parent::init();
        $this->debug = Config::getParam('debug', false);
        $this->provider = LoginProviderQuery::getProvider($this->getProviderName(), $this->debug);
        if(null === $this->provider) {
            Logger::log($this->getProviderName() . ' not defined for ' . ($this->debug) ? ' debug mode' : ' production mode');
            $this->provider = LoginProviderQuery::getProvider($this->getProviderName(), !$this->debug);
            if(null === $this->provider) {
                throw new AuthProviderNotConfiguredException(_('No se ha configurado ningún proveedor de redes sociales todavía'), 503);
            }
        }
    }

    /**
     * @throws AuthApiAccessRestrictedException
     */
    public static function checkAccess() {
        $isAdmin = Security::getInstance()->canAccessRestrictedAdmin();
        if(!$isAdmin) {
            throw new AuthApiAccessRestrictedException(_('Only administrators can access auth models'), 403);
        }
    }
}