<?php

namespace App\Repositories\Contracts;

interface AdditionalContactRepositoryInterface{
    public function find(int $id);
    public function getAdditionalContacts(int $id);
    public function update(Object $data, int $id);
    public function delete(int $id);
}
