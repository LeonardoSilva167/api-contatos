<?php

namespace App\Repositories;

use App\Exceptions\Message;
use App\Models\UserContact;
use App\Repositories\Contracts\UserContactRepositoryInterface;
use Illuminate\Support\Facades\DB;


class UserContactRepository implements UserContactRepositoryInterface
{
    private $model;

    public function __construct(UserContact $model)
    {
        $this->model = $model;
    }

    public function find($id){
        $this->model->find($id);
    }

    public function getUserContacts($id){

        return $this->model::where('user_id', $id)
                            ->orderBy('created_at', 'asc')
                            ->get();
                            
    }
    
    public function update($request, $id){

        try{
            DB::beginTransaction();
            $model = $this->model->find($id);

            $model->email      = $request['email'];
            $model->telefone      = $request['telefone'];
            $model->celular      = $request['celular'];
            
            if($model->save()){
                DB::commit();
                return ['error' => false,'state' => Message::SUCESSO, 'message' => Message::MSG_ALTERADO_SUCESSO];
            }
            
            return ['error' => true,'state' => Message::ERRO, 'message' => Message::MSG_ALGO_ERRADO];

        } catch (\Exception $e) {
            DB::rollback();
            // throw $e;
            return ['error' => true,'state' => Message::ERRO, 'message' => "Erro, $e"];
        }
    }
    
    public function delete($id){{

        try{
            DB::beginTransaction();
            $model = $this->model->find($id);
            
            if($model->delete()){
                DB::commit();
                return ['error' => false,'state' => Message::SUCESSO, 'message' => Message::MSG_REMOVIDO_SUCESSO];
            }

            return ['error' => true,'state' => Message::ERRO, 'message' => Message::MSG_ALGO_ERRADO];

        } catch (\Exception $e) {
            DB::rollback();
            // throw $e;
            return ['error' => true,'state' => Message::ERRO, 'message' => "Erro, $e"];
        }
    }}
}
