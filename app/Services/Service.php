<?php

namespace App\Services;

use App\Interfaces\CRUDInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Service implements CRUDInterface
{
    protected $repo;

    public function __construct($repo)
    {
        $this->repo = $repo;
    }

    public function get(): Collection
    {
        return $this->repo->get();
    }

    public function findByDate(string $date): Collection
    {
        return $this->repo->findByDate($date);
    }

    public function find(int $id): Model
    {
        return $this->repo->find($id);
    }

    public function create(array $data): Model
    {
        return $this->repo->create($data);
    }

    public function update(array $data, int $id): Model
    {
        return $this->repo->update($data, $id);
    }

    public function delete(int $id): bool
    {
        return $this->repo->delete($id);
    }
}
