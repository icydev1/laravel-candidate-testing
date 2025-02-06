<?php

namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

trait ApiRequestTrait
{
    
    public function makeApiRequest($method, $endpoint, $data = [], $headers = [])
    {
        //default headers
        $defaultHeaders = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];

        // Merge headers passed into the method with the default headers
        $headers = array_merge($defaultHeaders, $headers);

        // Create the client
        $client = new Client(['verify' => false]);  // Disable SSL verification 

        try {
           
            $options = [
                'headers' => $headers,
            ];

            // Add the data to the options if it's a POST request
            if ($method === 'POST') {
                $options['json'] = $data;
            }

            // Make the API request
            $response = $client->request($method, config('app.api_base_url') . $endpoint, $options);

            // Decode and return the response
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            // Handle errors 
            $errorMessage = $e->hasResponse() 
                ? json_decode($e->getResponse()->getBody()->getContents(), true)['detail'] ?? 'An error occurred.' 
                : $e->getMessage();

            return ['error' => 'Request failed. ' . $errorMessage];
        }
    }
}
