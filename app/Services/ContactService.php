<?php

namespace App\Services;

use App\Exceptions\Message;
use App\Models\AdditionalContact;
use App\Models\Contact;
use App\Repositories\AdditionalContactRepository\AdditionalContactRepository;
use App\Repositories\ContactRepository\ContactRepository;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ContactService
{

    protected $contactRepository;
    protected $additionalContactService;

    public function __construct(AdditionalContactService $additionalContactService)
    {
        $this->contactRepository = (new ContactRepository(new Contact()));
        $this->additionalContactService = $additionalContactService;
        // $this->additionalContactRepository = (new AdditionalContactRepository(new AdditionalContact()));

    }


    /**
     * busca a lista de paginas de menu do sistema
     *
     * @return array
     */
    public function getAll()
    {
        $result = $this->contactRepository->get();     

        if(is_null($result) || $result->count() == 0) {
            throw new \Exception(Message::MSG_NENHUM_REGISTRO_ENCONTRADO);
        }

        return $result;
    }

    public function create(Request $request)
    {
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['telephone'] = $request->telephone;
        $data['cell_phone'] = $request->cell_phone;
        $data['additional_contacts'] = $request->additional_contacts;


        $result = $this->contactRepository->create($data);

        if(!$result->id) {
            throw new \Exception(Message::MSG_ALGO_ERRADO);
        }
        
        if(!is_null($data['additional_contacts']) && sizeof($data['additional_contacts']) > 0){            
            $this->additionalContactService->create($request, $result->id);
        }
        
        return $result;      
    }

    public function getAllCustom($id){
        if(!$id){
            throw new \Exception(Message::MSG_ALGO_ERRADO);
        }

        $result =  $this->contactRepository->find($id);
        
        if(is_null($result) || $result->count() == 0) {
            throw new \Exception(Message::MSG_NENHUM_REGISTRO_ENCONTRADO);
        }

        $resultAdditionalContact = $this->additionalContactService->getAdditionalContacts($id);

        $resultAdditional = [];
        if(!is_null($resultAdditionalContact) && sizeof($resultAdditionalContact) > 0) {
            $resultAdditional = $resultAdditionalContact;
        }
        
        $result->additional_contacts = $resultAdditional;
        return $result;
    }

    public function update(Request $request, $id){
        
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['telephone'] = $request->telephone;
        $data['cell_phone'] = $request->cell_phone;
        $data['additional_contacts'] = $request->additional_contacts;
        $result = $this->contactRepository->update($data, $id);

        if(!$result) {
            throw new \Exception(Message::MSG_ALGO_ERRADO);
        }

        if(!is_null($data['additional_contacts'])){       
            $this->additionalContactService->update($request, $id);
        }
        
        return $result;      

    }
    
    public function delete($id){
        
        $additionalContacts= $this->additionalContactService->getAdditionalContacts($id);
        

        if(!is_null($additionalContacts) && sizeof($additionalContacts) > 0){
            $this->additionalContactService->delete($id, $additionalContacts);
        }

        $result = $this->contactRepository->delete($id);

        return $result;
    }

    public function getCountContacts()
    {
        return $this->contactRepository->getCountContacts();    

    }

    










    
}
