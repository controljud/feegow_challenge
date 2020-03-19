<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class HttpService 
{
    private $url;
    private $token;
    private $headers;

    public function __construct()
    {
        $this->url = config('feegow.api.url');
        $this->token = config('feegow.api.token');

        $this->headers = [
            'x-access-token' => $this->token
        ];
    }

    public function get($endpoint)
    {
        $response = Http::withHeaders($this->headers)
            ->get($this->url . $endpoint);

        return $response;
    }

    public function post($endpoint, $data)
    {
        $response = Http::withHeaders($this->headers)
            ->post($this->url . $endpoint, $data);
        
        return $response;
    }
}