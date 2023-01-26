<?php

namespace App\Repositories\AdditionalContactRepository;

use App\Repositories\BaseRepository;

class AdditionalContactRepository extends BaseRepository implements AdditionalContactRepositoryInterface
{
    public function getAdditionalContacts($id){

        return $this->model::where('contact_id', $id)
                            ->orderBy('created_at', 'asc')
                            ->get();
                            
    }
   
}
