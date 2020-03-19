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

    public function get($endpoint, $datas = null)
    {
        $vars = '';

        $firstData = true;
        if ($datas) {
            foreach($datas as $key => $data) {
                $symbol = '&';
                if ($firstData) {
                    $symbol = '?';
                    $firstData = false;
                }

                $vars .= $symbol . $key . '=' . $data;
            }
        }

        $response = Http::withHeaders($this->headers)
            ->get($this->url . $endpoint . $vars);

        return $response;
    }

    public function post($endpoint, $data)
    {
        $response = Http::withHeaders($this->headers)
            ->post($this->url . $endpoint, $data);
        
        return $response;
    }
}