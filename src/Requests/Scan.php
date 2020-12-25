<?php

namespace MWCopyleaks\Requests;

use GuzzleHttp\Client as GuzzleClient;

class Scan extends Request
{
    const API_SCAN_URI = 'v3/businesses/submit/file/';

    /**
     * access_token
     *
     * @var String
     */
    private $access_token;

    /**
     * __construct
     *
     * @param String $access_token
     * @return void
     */
    public function __construct(String $access_token)
    {
        $this->access_token = $access_token;
    }

    /**
     * Send scan request by file
     *
     * @return string
     */
    public function scanByFile($body_base64, $filename, $webhook_link, $scan_id, $sandbox = false)
    {
        // Create a client with a base URI
        $client = new GuzzleClient(['base_uri' => parent::API_BASE_URI]);
        $response = $client->request(
            'PUT',
            self::API_SCAN_URI . $scan_id,
            [
                'headers' => [
                    'Content-type' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->access_token
                ],
                'json' => [
                    'base64' => $body_base64,
                    'filename' => $filename,
                    'properties' => [
                        'webhooks' => [
                            'status' => $webhook_link
                        ],
                        'sandbox' => $sandbox
                    ]
                ]
            ]
        );
        return $response->getStatusCode();
    }
}
