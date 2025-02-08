<?php

namespace App\Services;

use App\Repositories\OccupationRepository;
use App\Services\API\HouseCallProApiService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class OccupationService extends Service
{
    protected $housecallProApiService;
    public function __construct(OccupationRepository $repo, HouseCallProApiService $houseCallProApiService)
    {
        parent::__construct($repo);
        $this->housecallProApiService = $houseCallProApiService;
    }

    public function getJobs(string $date): Collection
    {
        $occupations = parent::findByDate($date);

        if ($occupations->isEmpty()) {
            $occupations = $this->syncData($this->housecallProApiService->getApiJobs($date), $date);

        }

        return $occupations;
    }

    protected function syncData(SupportCollection $occupations, string $date): Collection
    {
        $data = $occupations->map(function ($occupation) {

            return [
                'job_id' => $occupation['id'],
                'invoice_number' => $occupation['invoice_number'],
                'date' => Carbon::parse($occupation['schedule']['scheduled_start'])->format('Y-m-d'),
                'total_amount' => $occupation['total_amount'],
                'customer_name' => $occupation['customer']['first_name'] . ' ' . $occupation['customer']['last_name'],
            ];
        })->toArray();
        $this->repo->insert($data);

        return parent::findByDate($date);
    }
}
