<?php

namespace App\Repositories;

abstract class BaseRepository
{
    protected $model;

    abstract protected function model();

    public function __construct()
    {
        $this->model = app($this->model());
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function updateOrCreate(array $dataCheck, array $dataUpdate = [])
    {
        return $this->model->updateOrCreate($dataCheck, $dataUpdate);
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }
}
