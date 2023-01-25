<?php

namespace App\Services;

use App\Exceptions\Message;
use App\Repositories\Contracts\AdditionalContactRepositoryInterface;
use App\Repositories\Contracts\ContactRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class ContactService
{
    /**
     * Instancia do Repository
     *
     * @var $contactInfoRepository
     */
    protected $contactRepository;

    /**
     * Construtor
     *
     * @param ContactRepositoryInterface $contactInfoRepository
     */
    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * busca a lista de paginas de menu do sistema
     *
     * @return array
     */
    public function getAll(){
        $list =  $this->contactRepository->getAll();

        if(is_null($list) || $list->count() == 0){
            return ['error' => false,'state' => Message::AVISO, 'message' => Message::MSG_NENHUM_REGISTRO_ENCONTRADO];
        }

        return $list;
    }

    public function create(Request $request){
        return $this->contactRepository->create($request);
    }

    public function find($id){
        $list =  $this->contactRepository->find($id);

        if(is_null($list) || $list->count() == 0){
            return ['error' => false,'state' => Message::AVISO, 'message' => Message::MSG_NENHUM_REGISTRO_ENCONTRADO];
        }

        return $list;
    }

    public function getAllCustom($id){
        $list =  $this->contactRepository->find($id);
        $additionalContacts = [];
        if(is_null($list) || $list->count() == 0){
            return ['error' => false,'state' => Message::AVISO, 'message' => Message::MSG_NENHUM_REGISTRO_ENCONTRADO];
        }
        else{
            $additionalContacts = app()->make(AdditionalContactRepositoryInterface::class)->getAdditionalContacts($list->id);
        }  

        $list->additional_contacts = $additionalContacts;
        return $list;
    }
    
    public function update(Request $request, $id){
        
        $contact = $this->contactRepository->update($request, $id);
        $additionalContact = [];

        if(!empty($request->additional_contacts)){            
            $additionalContactRepository = app()->make(AdditionalContactRepositoryInterface::class);
            
            foreach ($request->additional_contacts as $key => $value) {              
                $additionalContact[] = $additionalContactRepository->update($value, $value['id']);
            }
        }

        return $contact;
    }
    
    public function delete($id){
        
        $additionalContact = [];
        
        $additionalContactRepository = app()->make(AdditionalContactRepositoryInterface::class);
        $additionalContacts= $additionalContactRepository->getAdditionalContacts($id);


        foreach ($additionalContacts as $key => $value) {              
            $additionalContact[] = $additionalContactRepository->delete($value->id);
        }

        $contact = $this->contactRepository->delete($id);

        return $contact;
    }
}
