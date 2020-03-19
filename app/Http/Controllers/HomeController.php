<?php

namespace App\Http\Controllers;

use App\Services\HttpService;
use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    const SPECIALTIES_URL = 'specialties/list';

    public function index()
    {
        $service = new HttpService;
        $specialties = $service->get(self::SPECIALTIES_URL);

        $statusCode = $specialties->status();

        if ($statusCode == Response::HTTP_OK) {
            $json = $specialties->json();
            $content = $json['content'];
            
            return view('home')
                ->with('specialties', $content);
        }
    }
}