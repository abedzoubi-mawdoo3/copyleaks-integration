<?php

namespace MWCopyleaks\Requests;

use GuzzleHttp\Client as GuzzleClient;

class Download extends Request
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
     * Export downloaded reports
     * @param String $scan_id
     * @param String $export_id
     * @param String $webhook_link
     * @param String $endpoints
     * 
     * @return string
     */
    public function export(String $scan_id, String $export_id, String $webhook_link, String $results_endpoint)
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
                    [
                        'results' => [
                            'id' => "my-result-id",
                            'verb' => 'POST',
                            'endpoint' => $results_endpoint
                        ]
                    ],
                    'completionWebhook' => $webhook_link,
                    'maxRetries' => 3
                ]
            ]
        );
        return $response->getStatusCode();
    }
}
