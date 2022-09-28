<?php
/**
 * ClientCredentials.
 */

namespace Bmatovu\OAuthNegotiator\GrantTypes;

use GuzzleHttp\ClientInterface;

/**
 * Class ClientCredentials.
 */
class ClientCredentials implements GrantTypeInterface
{
    /**
     * The token endpoint client.
     *
     * @var \GuzzleHttp\ClientInterface
     */
    private $client;

    /**
     * Configuration settings.
     *
     * @var array
     */
    private $config;

    /**
     * Constructor.
     *
     * @param \GuzzleHttp\ClientInterface $client
     * @param array                       $config
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(ClientInterface $client, array $config)
    {
        $this->client = $client;

        $required = ['token_uri', 'client_id', 'client_secret'];

        if ($missing = missing_keys($required, $config)) {
            $message = 'Parameters: '.implode(', ', $missing).' are required.';

            throw new \InvalidArgumentException($message, 0);
        }

        $this->config = array_merge([
            'scope' => '',
        ], $config);
    }

    /**
     * {@inheritdoc}
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getToken($refreshToken = null)
    {
        $response = $this->client->request('POST', $this->config['token_uri'], [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic '.base64_encode($this->config['client_id'].':'.$this->config['client_secret']),
            ],
            'json' => [
                'grant_type' => 'client_credentials',
                'scope' => $this->config['scope'],
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
