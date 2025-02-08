<?php

namespace App\Services\API;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class HouseCallProApiService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey =  config('app.house_call_pro_api_key');
    }

    public function getApiJobs(string $date)
    {

        try {
            $startOfDay = Carbon::parse($date)->startOfDay()->format('Y-m-d\TH:i:s\Z');
            $endOfDay = Carbon::parse($date)->endOfDay()->format('Y-m-d\TH:i:s\Z');

            $client = new \GuzzleHttp\Client();

            $response = $client->request('GET', 'https://api.housecallpro.com/jobs?', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->apiKey
                ],
                'query' => [
                    'scheduled_start_min' => $startOfDay,
                    'scheduled_start_max' => $endOfDay,
                    'scheduled_end_min' => $startOfDay,
                    'scheduled_end_max' => $endOfDay,
                ],

            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            return collect($data['jobs']);

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            dd($e->getMessage(), $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null);
        }
    }
}
