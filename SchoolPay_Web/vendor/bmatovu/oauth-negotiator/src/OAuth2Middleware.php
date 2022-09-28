<?php
/**
 * OAuth2Middleware.
 */

namespace Bmatovu\OAuthNegotiator;

use Bmatovu\OAuthNegotiator\Exceptions\TokenRequestException;
use Bmatovu\OAuthNegotiator\Repositories\FileTokenRepository;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\RequestInterface;

/**
 * Class OAuth2Middleware.
 */
class OAuth2Middleware
{
    /**
     * Primary grant type.
     *
     * @var \Bmatovu\OAuthNegotiator\GrantTypes\GrantTypeInterface
     */
    protected $grantType;

    /**
     * Refresh token (secondary) grant type.
     *
     * @var \Bmatovu\OAuthNegotiator\GrantTypes\GrantTypeInterface
     */
    protected $refreshTokenGrantType;

    /**
     * Token repository.
     *
     * @var \Bmatovu\OAuthNegotiator\Repositories\TokenRepositoryInterface
     */
    protected $tokenRepository;

    /**
     * Token model.
     *
     * @var \Bmatovu\OAuthNegotiator\Models\TokenInterface
     */
    protected $token;

    /**
     * Get main grant type.
     *
     * @codeCoverageIgnore
     *
     * @return \Bmatovu\OAuthNegotiator\GrantTypes\GrantTypeInterface
     */
    public function getGrantType()
    {
        return $this->grantType;
    }

    /**
     * Set main grant type.
     *
     * @codeCoverageIgnore
     *
     * @param \Bmatovu\OAuthNegotiator\GrantTypes\GrantTypeInterface $grantType
     */
    public function setGrantType(GrantTypeInterface $grantType)
    {
        $this->grantType = $grantType;
    }

    /**
     * Get refresh token grant type.
     *
     * @codeCoverageIgnore
     *
     * @return \Bmatovu\OAuthNegotiator\GrantTypes\GrantTypeInterface
     */
    public function getRefreshTokenGrantType()
    {
        return $this->refreshTokenGrantType;
    }

    /**
     * Set refresh token grant type.
     *
     * @codeCoverageIgnore
     *
     * @param \Bmatovu\OAuthNegotiator\GrantTypes\GrantTypeInterface $refreshTokenGrantType
     */
    public function setRefreshTokenGrantType(GrantTypeInterface $refreshTokenGrantType)
    {
        $this->refreshTokenGrantType = $refreshTokenGrantType;
    }

    /**
     * Set token.
     *
     * @codeCoverageIgnore
     *
     * @param \Bmatovu\OAuthNegotiator\Models\TokenInterface $token
     */
    public function setToken(TokenInterface $token)
    {
        $this->token = $token;
    }

    /**
     * Get a valid access token.
     *
     * @throws TokenRequestException
     *
     * @return \Bmatovu\OAuthNegotiator\Models\TokenInterface|null
     */
    public function getToken()
    {
        // If token is not set try to get it from the persistent storage.
        if ($this->token === null) {
            $this->token = $this->tokenRepository->retrieve();
        }

        // If storage token is not set or expired then try to acquire a new one...
        if ($this->token === null || $this->token->isExpired()) {

            // Hydrate `rawToken` with a new access token
            $this->token = $this->requestNewToken();
        }

        return $this->token;
    }

    /**
     * Set token repository.
     *
     * @codeCoverageIgnore
     *
     * @param \Bmatovu\OAuthNegotiator\Repositories\TokenRepositoryInterface $tokenRepository
     */
    public function setTokenRepository(TokenRepositoryInterface $tokenRepository)
    {
        $this->tokenRepository = $tokenRepository;
    }

    /**
     * Get token repository.
     *
     * @codeCoverageIgnore
     *
     * @return \Bmatovu\OAuthNegotiator\Repositories\TokenRepositoryInterface
     */
    public function getTokenRepository()
    {
        return $this->tokenRepository;
    }

    /**
     * Constructor.
     *
     * @param \Bmatovu\OAuthNegotiator\GrantTypes\GrantTypeInterface         $grantType
     * @param \Bmatovu\OAuthNegotiator\GrantTypes\GrantTypeInterface         $refreshTokenGrantType
     * @param \Bmatovu\OAuthNegotiator\Repositories\TokenRepositoryInterface $tokenRepository
     */
    public function __construct($grantType, $refreshTokenGrantType = null, $tokenRepository = null)
    {
        $this->grantType = $grantType;
        $this->refreshTokenGrantType = $refreshTokenGrantType;
        $this->tokenRepository = ($tokenRepository) ? $tokenRepository : new FileTokenRepository();
    }

    /**
     * Guzzle middleware invocation.
     *
     * @param callable $handler
     *
     * @return \Closure
     */
    public function __invoke(callable $handler)
    {
        return function (RequestInterface $request, array $options) use ($handler) {
            if (! $request->hasHeader('Authorization')) {
                $request = $this->signRequest($request, $this->getToken());
            }

            return $handler($request, $options)->then(
                $this->onFulfilled($request, $options, $handler),
                $this->onRejected($request, $options, $handler)
            );
        };
    }

    /**
     * Request error event handler.
     *
     * Handles unauthorized errors by acquiring a new access token and retrying the request.
     *
     * @param \Psr\Http\Message\RequestInterface $request
     * @param array                              $options
     * @param callable                           $handler
     *
     * @return \Closure
     */
    private function onFulfilled(RequestInterface $request, array $options, callable $handler)
    {
        return function ($response) use ($request, $options, $handler) {
            // Only deal with Unauthorized response.
            if ($response && $response->getStatusCode() != 401) {
                return $response;
            }

            // If we already retried once, give up.
            if ($request->hasHeader('X-Guzzle-Retry')) {
                return $response;
            }

            // Delete the previous access token, if any
            $this->tokenRepository->delete($this->token->getAccessToken());

            // Unset current token
            $this->token = null;

            // Acquire a new access token, and retry the request.
            $this->token = $this->getToken();

            $request = $request->withHeader('X-Guzzle-Retry', '1');

            $request = $this->signRequest($request, $this->token);

            return $handler($request, $options);
        };
    }

    /**
     * When request is rejected.
     *
     * @param \Psr\Http\Message\RequestInterface $request
     * @param array                              $options
     * @param callable                           $handler
     *
     * @return \Closure
     */
    private function onRejected(RequestInterface $request, array $options, callable $handler)
    {
        return function ($reason) {
            return \GuzzleHttp\Promise\rejection_for($reason);
        };
    }

    /**
     * Add auth headers.
     *
     * @param \Psr\Http\Message\RequestInterface             $request
     * @param \Bmatovu\OAuthNegotiator\Models\TokenInterface $token
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    protected function signRequest(RequestInterface $request, $token)
    {
        return $request->withHeader('Authorization', $this->token->getTokenType().' '.$this->token->getAccessToken());
    }

    /**
     * Acquire a new access token from the oauth2 server.
     *
     * @throws \Bmatovu\OAuthNegotiator\Exceptions\TokenRequestException
     *
     * @return \Bmatovu\OAuthNegotiator\Models\TokenInterface
     */
    protected function requestNewToken()
    {
        try {
            // Refresh an existing, but expired access token.
            if ($this->refreshTokenGrantType && $this->token && $this->token->getRefreshToken()) {
                // Request new access token using the existing refresh token.
                $api_token = $this->refreshTokenGrantType->getToken($this->token->getRefreshToken());

                return $this->tokenRepository->create($api_token);
            }

            // Obtain new access token using the main grant type.
            $api_token = $this->grantType->getToken();

            return $this->tokenRepository->create($api_token);
        } catch (RequestException $ex) {
            throw new TokenRequestException('Unable to obtain a new access token.', 0, $ex->getPrevious());
        }
    }
}
