<?php

namespace App\Repositories;

use App\Models\Occupation;

class OccupationRepository extends Repository
{
    public function __construct(Occupation $model)
    {
        parent::__construct($model);
    }


    public function insert(array $data): void
    {
        $this->model->insert($data);
    }
}
