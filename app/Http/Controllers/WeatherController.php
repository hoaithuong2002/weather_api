<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    function index (){
        $response = Http::get('api.openweathermap.org/data/2.5/weather', [
            'q' => 'Tỉnh Phú Thọ',
            'appid' => 'd6010f5f221bcc54cff44633720ad8f1'
        ]);
        $dataJson = json_decode($response->body());
//        dd($dataJson);

        $temperature = $dataJson->main->temp - 273;
        $weather = $dataJson->weather;
        $weatherType = $weather[0]->main;

        $data = [
            'temperature' => $temperature,
            'weather_type' => $weatherType,
            'city_name' => $dataJson->name
        ];

        return view('home', compact('data'));
    }
}
