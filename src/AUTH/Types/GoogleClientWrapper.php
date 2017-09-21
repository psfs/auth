<?php
namespace AUTH\Types;
/**
 * Class GoogleClientWrapper
 * @package AUTH\Types
 */
class GoogleClientWrapper extends \Google_Client {

    /**
     * @var string
     */
    protected $aud = null;

    /**
     * @var array
     */
    protected $config = [];

    public function verifyIdToken($idToken = null)
    {
        $tokenVerifier = new \Google_AccessToken_Verify(
            $this->getHttpClient(),
            $this->getCache(),
            $this->config['jwt']
        );

        if (null === $idToken) {
            $token = $this->getAccessToken();
            if (!isset($token['id_token'])) {
                throw new \Exception(
                    'id_token must be passed in or set as part of setAccessToken'
                );
            }
            $idToken = $token['id_token'];
        }

        return $tokenVerifier->verifyIdToken(
            $idToken,
            $this->getAud()
        );
    }

    /**
     * @return string
     */
    public function getAud()
    {
        return $this->aud;
    }

    /**
     * @param string $aud
     */
    public function setAud(string $aud)
    {
        $this->aud = $aud;
    }
}