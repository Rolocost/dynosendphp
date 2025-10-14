<?php

namespace DynosendSDK\Resource;

class Base {
    private $client;
    
    public function getSubject() {
        return false;
    }

    public function __construct($attributes = [], $client)
    {
        $this->client = $client;
    }

	public function makeRequest($action = '', $method = 'POST', $params = [], $headers = []) {
        $uri = $this->client->getUri();
        
        if ($this->getSubject()) {
            $uri = $uri . '/' . $this->getSubject();
        }
        if ($action) {
            $uri = $uri . '/' . $action;
        }
        
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $headers = array_merge([
		    'Content-Type' => 'application/json',
		    'Authorization' => "Bearer " . $this->client->getToken(),
		], (array) $headers);
        try {
            $response = $client->request($method, $uri, [
                'headers' => $headers,
                'body' => json_encode($params),
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if ($e->hasResponse()) {
				$statusCode = $e->getResponse()->getStatusCode();
				$responseBody = json_decode($e->getResponse()->getBody(), true);
				return [
					'error' => true,
					'error_code' => $statusCode,
					'message' => json_encode($responseBody),
				];
			} else {
				return [
					'error' => true,
					'error_code' => $e->getCode(),
					'message' => 'An error occurred without a response',
				];
			}
        }
        
        return json_decode($response->getBody(), true);
	}
}
