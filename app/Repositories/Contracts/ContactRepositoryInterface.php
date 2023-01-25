<?php

namespace App\Repositories\Contracts;

interface ContactRepositoryInterface{

    public function getAll();
    public function create(Object $data);
    public function find(int $id);
    public function update(Object $data, int $id);
    public function delete(int $id);
    
}
