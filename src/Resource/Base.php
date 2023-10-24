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

    public function all($params = []) {
		return $this->makeRequest('', 'GET', $params);
	}

    public function create($params) {
		return $this->makeRequest('', 'POST', $params);
    }
    
    public function find($uid) {
		return $this->makeRequest($uid, 'GET');
    }
    
    public function update($email, $params) {
		return $this->makeRequest($email, 'PATCH', $params);
    }
    
    public function delete($uid) {
		return $this->makeRequest($uid, 'DELETE');
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
        ], $headers);
        try {
            $response = $client->request($method, $uri, [
                'headers' => $headers,
                'body' => json_encode(array_merge(['api_token' => $this->client->getToken()], $params)),
            ]);
        } catch (\Exception $e) {
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
					'error_code' => $statusCode,
					'message' => json_encode($responseBody),
				];
			}
        }
        
        return json_decode($response->getBody(), true);
	}
}