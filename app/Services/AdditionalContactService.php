<?php

namespace App\Services;

use App\Exceptions\Message;
use App\Http\Resources\BaseCollection;
use App\Models\AdditionalContact;
use App\Repositories\AdditionalContactRepository\AdditionalContactRepository;
use Illuminate\Http\Request;

class AdditionalContactService
{
    /**
     * Instancia do Repository
     *
     * @var $additionalContactRepository
     */
    protected $additionalContactRepository;

    public function __construct()
    {
        $this->additionalContactRepository = (new AdditionalContactRepository(new AdditionalContact()));
    }
    
    public function create(Request $request, int $id = null)
    {
        $data['additional_contacts'] = $request->additional_contacts;

        if(!is_null($data['additional_contacts']) && sizeof($data['additional_contacts']) > 0 && $id){    
            foreach ($data['additional_contacts'] as $key => $value) {              
                $value['contact_id'] = $id;
                $result = $this->additionalContactRepository->create($value, $id);

                if(!$result->id) {
                    throw new \Exception(Message::MSG_ALGO_ERRADO);
                }
            }
        }else{

            $data['contact_id'] = $request->contact_id;
            $data['email'] = $request->email;
            $data['telephone'] = $request->telephone;
            $data['cell_phone'] = $request->cell_phone;

            $result = $this->additionalContactRepository->create($data, $id);

            if(!$result->id) {
                throw new \Exception(Message::MSG_ALGO_ERRADO);
            }
        }
        return $result;
    }
    
    
    public function getAdditionalContacts(int $id){
        return $this->additionalContactRepository->getAdditionalContacts($id);
    }

    
    public function update(Request $request, $id){
        
        $data['additional_contacts'] = $request->additional_contacts;
        
        if(!is_null($data['additional_contacts']) && sizeof($data['additional_contacts']) > 0){    
            foreach ($data['additional_contacts'] as $key => $value) {              
                if(!empty($value['id'])){
                    $result = $this->additionalContactRepository->update($value, $value['id']);                                        
                    if(!$result) {
                        throw new \Exception(Message::MSG_ALGO_ERRADO);
                    }
                }
                else{
                    $value['contact_id'] = $id;
                    $result = $this->additionalContactRepository->create($value, $id);   
                    if(!$result->id) {
                        throw new \Exception(Message::MSG_ALGO_ERRADO);
                    }   
                }
            }
        }else{

            $data['email'] = $request->email;
            $data['telephone'] = $request->telephone;
            $data['cell_phone'] = $request->cell_phone;

            $result = $this->additionalContactRepository->update($data, $id);

            if(!$result->id) {
                throw new \Exception(Message::MSG_ALGO_ERRADO);
            }
        }
        return $result;
    }

    public function delete($id, $request = []){

        if(!is_null($request) && sizeof($request) > 0){    
            foreach ($request as $key => $value) {              
                $result = $this->additionalContactRepository->delete($value['id']);                                        
                if(!$result) {
                    throw new \Exception(Message::MSG_ALGO_ERRADO);
                } 
            }
        }else{
            $result = $this->additionalContactRepository->delete($id);
        }

        return $result;
    }

}
