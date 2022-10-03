<?php

namespace App\Infrastructure\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class BaseRepository
{
	protected $model;

	public function __construct(Model $model)
	{
		$this->model = $model;
	}

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

	public function all(): Collection
	{
		return $this->model->all();
	}

    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    public function update(array $data, $id)
    {
        $record = $this->find($id);
        return $record->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    public function with($relations)
    {
        return $this->model->with($relations);
    }
}
