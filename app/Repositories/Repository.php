<?php

namespace App\Repositories;

use App\Interfaces\CRUDInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Repository implements CRUDInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function get(): Collection
    {
        return $this->model->get();
    }

    public function findByDate(string $date): Collection
    {
        return $this->model->whereDate('date', $date)->get();
    }

    public function find(int $id): Model
    {
        return $this->model->where('id', $id)->first();
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(array $data, int $id): Model
    {
        $model = $this->model->findOrFail($id);

        $model->update($data);

        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->model->findOrFail($id);
        return $model->delete();
    }
}
