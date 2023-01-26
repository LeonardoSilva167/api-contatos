<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface BaseInterface
{
    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id);

    /**
     * @return mixed
     */
    public function get();

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data, int $id = null):Model;

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(array $data, int $id);

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id, array $data = []):bool;

    /**
     * @param int $id
     * @return bool
     */
    public function forceDelete(int $id):bool;
}
