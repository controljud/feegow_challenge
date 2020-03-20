<?php

namespace App\Http\Controllers;

use App\Services\HttpService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\ScheduleRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Lang;
use App\Models\Schedule;

class HomeController
{
    private $specialtiesUrl;
    private $professionalsUrl;
    private $howKnowUrl;
    private $service;

    public function __construct()
    {
        $this->specialtiesUrl = config('feegow.endpoints.specialties');
        $this->professionalsUrl = config('feegow.endpoints.professionals');
        $this->howKnowUrl = config('feegow.endpoints.howknow');
        
        $this->service = new HttpService;
    }

    public function index()
    {
        $specialties = $this->service->get($this->specialtiesUrl);
        $howknows = $this->service->get($this->howKnowUrl);

        $statusCode = $specialties->status();

        $jsonSpec = $specialties->json();
        $contentSpec = $jsonSpec['content'];

        $jsonHowKnow = $howknows->json();
        $contentHowKnow = $jsonHowKnow['content'];
        
        return view('home')
            ->with('howknows', $contentHowKnow)
            ->with('specialties', $contentSpec);
    }

    public function getProfessionals(Request $request)
    {
        $id = $request->get('id');
        $vars = [
            'especialidade_id' => $id
        ];

        $professionals = $this->service->get($this->professionalsUrl, $vars);

        $statusCode = $professionals->status();

        if ($statusCode == Response::HTTP_OK) {
            $json = $professionals->json();
            $content = $json['content'];
            
            return response()->json(['professionals' => $content]);
        }
    }

    public function store(ScheduleRequest $request)
    {
        try {
            $schedule = new Schedule;
            $schedule->fill($request->all());
            
            if ($schedule->save())
            {
                return redirect()->action('HomeController@index')
                    ->with('message', Lang::get('schedule.save_successfully'));
            }
        } catch (\Exception $ex) {
            return redirect()->action('HomeController@index')
                    ->withErrors();
        }
    }
}