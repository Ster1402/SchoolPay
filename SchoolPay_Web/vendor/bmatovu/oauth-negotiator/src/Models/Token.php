<?php
/**
 * Token.
 */

namespace Bmatovu\OAuthNegotiator\Models;

use DateTime;
use DateInterval;

/**
 * Class Token.
 */
class Token implements TokenInterface
{
    /**
     * Access token.
     *
     * @var string
     */
    protected $access_token;

    /**
     * Refresh token.
     *
     * @var string
     */
    protected $refresh_token;

    /**
     * Token type.
     *
     * @var string
     */
    protected $token_type;

    /**
     * Expires at.
     *
     * @var \DateTime
     */
    protected $expires_at = null;

    /**
     * Constructor.
     *
     * @param string $access_token
     * @param string $refresh_token
     * @param string $token_type
     * @param int    $expires_in
     */
    public function __construct($access_token, $refresh_token = null, $token_type = 'Bearer', $expires_in = null)
    {
        $this->access_token = $access_token;

        $this->refresh_token = $refresh_token;

        $this->token_type = $token_type;

        // Enable negative expires_in; for testing...

        if ($expires_in === null) {
            return;
        }

        if ($expires_in < 0) {
            $expires_in = abs($expires_in);

            $di = new \DateInterval("PT{$expires_in}S");

            $di->invert = $expires_in;
        } elseif ($expires_in >= 0) {
            $di = new \DateInterval("PT{$expires_in}S");
        }

        $this->expires_at = (new \DateTime())->add($di)->format('Y-m-d H:i:s');
    }

    /**
     * Set access token.
     *
     * @param string $access_token
     */
    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
    }

    /**
     * Get access token.
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * Set refresh token.
     *
     * @param string $refresh_token
     */
    public function setRefreshToken($refresh_token)
    {
        $this->refresh_token = $refresh_token;
    }

    /**
     * Get refresh token.
     *
     * @return string|null
     */
    public function getRefreshToken()
    {
        return $this->refresh_token;
    }

    /**
     * Set token type.
     *
     * @param string $token_type
     */
    public function setTokenType($token_type)
    {
        $this->token_type = $token_type;
    }

    /**
     * Get token type.
     *
     * @return string
     */
    public function getTokenType()
    {
        return $this->token_type;
    }

    /**
     * Set expires at.
     *
     * @param string|null $expires_at
     */
    public function setExpiresAt($expires_at)
    {
        $this->expires_at = $expires_at;
    }

    /**
     * Get expires at.
     *
     * @return string|null
     */
    public function getExpiresAt()
    {
        return $this->expires_at;
    }

    /**
     * Determine if a token is expired.
     *
     * @return bool
     */
    public function isExpired()
    {
        if (is_null($this->expires_at)) {
            return false;
        }

        $expires_at = \DateTime::createFromFormat('Y-m-d H:i:s', $this->expires_at);

        $now = new \DateTime();

        return $now > $expires_at;
    }
}
