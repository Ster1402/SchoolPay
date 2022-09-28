<?php
/**
 * TokenRepositoryInterface.
 */

namespace Bmatovu\OAuthNegotiator\Repositories;

/**
 * Interface TokenRepositoryInterface.
 */
interface TokenRepositoryInterface
{
    /**
     * Create token.
     *
     * @param array $attributes
     *
     * @return \Bmatovu\OAuthNegotiator\Models\TokenInterface Token created.
     */
    public function create(array $attributes);

    /**
     * Retrieve token.
     *
     * Specified token, or any token available in storage.
     *
     * @param string $access_token
     *
     * @throws \Bmatovu\OAuthNegotiator\Exceptions\TokenNotFoundException
     *
     * @return \Bmatovu\OAuthNegotiator\Models\TokenInterface|null Token, null if non found.
     */
    public function retrieve($access_token = null);

    /**
     * Updates token.
     *
     * @param mixed $access_token
     * @param array $attributes
     *
     * @throws \Bmatovu\OAuthNegotiator\Exceptions\TokenNotFoundException
     *
     * @return \Bmatovu\OAuthNegotiator\Models\TokenInterface Token
     */
    public function update($access_token, array $attributes);

    /**
     * Destroy token.
     *
     * @param string $access_token
     *
     * @throws \Bmatovu\OAuthNegotiator\Exceptions\TokenNotFoundException
     *
     * @return void
     */
    public function delete($access_token);
}
