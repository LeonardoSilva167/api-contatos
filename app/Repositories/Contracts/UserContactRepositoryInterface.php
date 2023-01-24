<?php

namespace App\Repositories\Contracts;

interface UserContactRepositoryInterface{
    public function find(int $id);
    public function getUserContacts(int $id);
    public function update(Object $data, int $id);
    public function delete(int $id);
}
