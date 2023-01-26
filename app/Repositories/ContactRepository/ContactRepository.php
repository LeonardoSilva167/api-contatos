<?php

namespace App\Repositories\ContactRepository;

use App\Repositories\BaseRepository;

class ContactRepository extends BaseRepository implements ContactRepositoryInterface
{
    public function getCountContacts(){
        return $this->model->get()->count();
    }
}
