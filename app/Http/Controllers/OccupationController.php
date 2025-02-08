<?php

namespace App\Http\Controllers;

use App\Services\OccupationService;
use Illuminate\Http\Request;

class OccupationController extends Controller
{
    protected $service;

    public function __construct(OccupationService $occupationService)
    {
        $this->service = $occupationService;
    }
    public function index()
    {
        $occupations = $this->service->get();

        return view('welcome', ['occupations' => $occupations]);
    }
    public function getJobs(string $date)
    {
        return $this->service->getJobs($date);
    }
}
