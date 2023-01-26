<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BaseRepository implements BaseInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
        
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->model->get();
    }

    /**
     * @param array data
     * @return Model
     */
    public function create(array $data, int $id = null):Model
    {
        return $this->model->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(array $data, int $id)
    {
        return $this->model->find($id)->update($data);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id, array $data = []):bool
    {
        return $this->model->find($id)->delete();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function forceDelete(int $id):bool
    {
        return $this->model->find($id)->forceDelete();
    }
}
