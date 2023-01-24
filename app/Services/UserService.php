<?php

namespace App\Services;

use App\Exceptions\Message;
use App\Repositories\Contracts\UserContactRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class UserService
{
    /**
     * Instancia do Repository
     *
     * @var $userInfoRepository
     */
    protected $userRepository;

    /**
     * Construtor
     *
     * @param userRepositoryInterface $userInfoRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * busca a lista de paginas de menu do sistema
     *
     * @return array
     */
    public function getAll(){
        $list =  $this->userRepository->getAll();

        if(is_null($list) || $list->count() == 0){
            return ['error' => false,'state' => Message::AVISO, 'message' => Message::MSG_NENHUM_REGISTRO_ENCONTRADO];
        }

        return $list;
    }

    public function create(Request $request){
        return $this->userRepository->create($request);
    }

    public function find($id){
        $list =  $this->userRepository->find($id);

        if(is_null($list) || $list->count() == 0){
            return ['error' => false,'state' => Message::AVISO, 'message' => Message::MSG_NENHUM_REGISTRO_ENCONTRADO];
        }

        return $list;
    }

    public function getUserData($id){
        $list =  $this->userRepository->find($id);
        $userContacts = [];

        if(is_null($list) || $list->count() == 0){
            return ['error' => false,'state' => Message::AVISO, 'message' => Message::MSG_NENHUM_REGISTRO_ENCONTRADO];
        }
        else{
            $userContacts = app()->make(UserContactRepositoryInterface::class)->getUserContacts($list->id);
        }  

        $list->contacts = $userContacts;
        return $list;
    }
    
    public function update(Request $request, $id){
        
        $user = $this->userRepository->update($request, $id);
        $userContact = [];

        if(!empty($request->contacts)){            
            $userContactRepository = app()->make(UserContactRepositoryInterface::class);
            
            foreach ($request->contacts as $key => $value) {              
                $userContact[] = $userContactRepository->update($value, $value['id']);
            }
        }

        return $user;
    }
    
    public function delete($id){
        
        $userContact = [];
        
        $userContactRepository = app()->make(UserContactRepositoryInterface::class);
        $userContacts= $userContactRepository->getUserContacts($id);


        foreach ($userContacts as $key => $value) {              
            $userContact[] = $userContactRepository->delete($value->id);
        }

        $user = $this->userRepository->delete($id);

        return $user;
    }
}
