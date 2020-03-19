<?php

namespace App\Http\Controllers;

use App\Services\HttpService;
use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    private $specialtiesUrl;

    public function __construct()
    {
        $this->specialtiesUrl = config('feegow.endpoints.specialties');
    }

    public function index()
    {
        $service = new HttpService;
        $specialties = $service->get($this->specialtiesUrl);

        $statusCode = $specialties->status();

        if ($statusCode == Response::HTTP_OK) {
            $json = $specialties->json();
            $content = $json['content'];
            
            return view('home')
                ->with('specialties', $content);
        }
    }
}