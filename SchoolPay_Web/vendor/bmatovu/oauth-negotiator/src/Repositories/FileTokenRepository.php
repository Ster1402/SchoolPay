<?php
/**
 * FileTokenRepository.
 */

namespace Bmatovu\OAuthNegotiator\Repositories;

use Bmatovu\OAuthNegotiator\Exceptions\TokenNotFoundException;
use Bmatovu\OAuthNegotiator\Models\Token;

/**
 * Class FileTokenRepository.
 */
class FileTokenRepository implements TokenRepositoryInterface
{
    /**
     * Token file.
     *
     * @var string
     */
    protected $tokenFile = 'token.key';

    /**
     * Get token file.
     *
     * @return string file
     */
    public function getTokenFile()
    {
        return $this->tokenFile;
    }

    /**
     * Set token file.
     *
     * @param string $tokenFile
     */
    public function setTokenFile($tokenFile)
    {
        $this->tokenFile = $tokenFile;
    }

    /**
     * Constructor.
     *
     * @param string $tokenFile
     */
    public function __construct($tokenFile = 'token.txt')
    {
        $this->tokenFile = $tokenFile;
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $attributes)
    {
        $token = new Token(
            array_get($attributes, 'access_token'),
            array_get($attributes, 'refresh_token'),
            array_get($attributes, 'token_type', 'Bearer'),
            array_get($attributes, 'expires_in')
        );

        file_put_contents($this->tokenFile, serialize($token));

        return $token;
    }

    /**
     * {@inheritdoc}
     */
    public function retrieve($access_token = null)
    {
        if (!file_exists($this->tokenFile)) {
            return null;
        }

        $rawToken = file_get_contents($this->tokenFile);

        $token = $rawToken ? unserialize($rawToken) : null;

        if ($access_token) {
            if (!$token || ($token->getAccessToken() != $access_token)) {
                throw new TokenNotFoundException('Missing token.');
            }
        }

        return $token;
    }

    /**
     * {@inheritdoc}
     */
    public function update($access_token, array $attributes)
    {
        $rawToken = file_get_contents($this->tokenFile);

        $token = $rawToken ? unserialize($rawToken) : null;

        if (!$token || ($token->getAccessToken() != $access_token)) {
            throw new TokenNotFoundException('Missing token.');
        }

        unlink($this->tokenFile);

        // Create new/updated token
        $token = new Token(
            array_get($attributes, 'access_token'),
            array_get($attributes, 'refresh_token'),
            array_get($attributes, 'token_type'),
            array_get($attributes, 'expires_in')
        );

        // Overwrite
        file_put_contents($this->tokenFile, serialize($attributes));

        return $token;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($access_token)
    {
        $rawToken = file_get_contents($this->tokenFile);

        $token = $rawToken ? unserialize($rawToken) : null;

        if (!$token || ($token->getAccessToken() != $access_token)) {
            throw new TokenNotFoundException('Missing token.');
        }

        unlink($this->tokenFile);
    }
}
