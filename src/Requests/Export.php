<?php

namespace MWCopyleaks\Requests;

use GuzzleHttp\Client as GuzzleClient;

class Scan extends Request
{
    const API_SCAN_URI = 'v3/downloads/';

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
     * Authenticate Copyleaks API using client credentials and get token
     *
     * @return string
     */
    public function scanByFile($scan_id, $export_id, $filename, $webhook_link)
    {
        // Create a client with a base URI
        $client = new GuzzleClient(['base_uri' => self::API_BASE_URI]);
        $response = $client->request(
            'POST',
            self::API_SCAN_URI . $scan_id . '/export/' . $export_id,
            [
                'headers' => [
                    'Content-type' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->access_token
                ],
                'json' => [
                    'results' => [
                        'id' => $result_id,
                        'verb' => 'POST',
                        'endpoint'
                    ],
                    'completionWebhook' => $filename,
                    'maxRetries' => 3
                ]
            ]
        );
        return $response->getStatusCode();
    }
}
