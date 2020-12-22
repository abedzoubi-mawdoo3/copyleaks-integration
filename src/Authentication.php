<?php

namespace MWCopyleaks;

use GuzzleHttp\Client as GuzzleClient;

class Authentication
{
    const AUTH_BASE_URI = 'https://id.copyleaks.com';

    const AUTH_URI = 'v3/account/login/api';

    /**
     * client_email
     *
     * @var String
     */
    private $client_email;

    /**
     * client_key
     *
     * @var String
     */
    private $client_key;

    /**
     * __construct
     *
     * @param String $client_email
     * @param String $client_key
     * @return void
     */
    public function __construct(String $client_email, String $client_key)
    {
        $this->client_email = $client_email;
        $this->client_key = $client_key;
    }

    /**
     * Authenticate Copyleaks API using client credentials and get token
     *
     * @return String access_token
     */
    public function getAccessToken()
    {
        // Create a client with a base URI
        $client = new GuzzleClient(['base_uri' => self::AUTH_BASE_URI]);
        $response = $client->request(
            'POST',
            self::AUTH_URI,
            [
                'headers' => [
                    'Content-type' => 'application/json'
                ],
                'json' => [
                    'email' => $this->client_email,
                    'key' => $this->client_key,
                ]
            ]
        );
        $responseToken = json_decode($response->getBody()->getContents());

        return $responseToken->access_token;
    }
}
