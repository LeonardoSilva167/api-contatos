<?php

namespace App\Repositories;

use App\Exceptions\Message;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = new $model;
    }

    public function getAll(){
        return $this->model->all();
    }

    public function create($request){

        try{
            DB::beginTransaction();
            
            // $user = hasValue([$request->email,$request->telefone,$request->celular],['email','telefone','celular'], $this->model)->getData();
            $user = hasValue($request->email,'email', $this->model)->getData();
            
            if($user){
                return ['error' => false,'state' => Message::AVISO, 'message' => 'Email já existe.'];
            }

            $this->model->name      = trim($request->name);
            $this->model->password     = Hash::make(trim($request->password));
            $this->model->email  = trim($request->email);
            $this->model->telefone     = trim(trim($request->telefone));
            $this->model->celular     = trim(trim($request->celular));

            DB::commit();

            if($this->model->save()){
                return ['error' => false,'state' => Message::SUCESSO, 'message' => Message::MSG_INSERIDO_SUCESSO];
            }

            return ['error' => true,'state' => Message::ERRO, 'message' => Message::MSG_ALGO_ERRADO];


        } catch (\Exception $e) {
            DB::rollback();
            return ['error' => true,'state' => Message::ERRO, 'message' => "Erro, $e"];
        }
    }

    public function find($id){
        return $this->model->find($id);
    }

    public function update($request, $id){
        try{
            DB::beginTransaction();
            $model = $this->model->find($id);

            $model->name     = trim($request->name);
            $model->password  = Hash::make(trim($request->password));
            $model->email      = $request->email;
            $model->telefone      = $request->telefone;
            $model->celular      = $request->celular;
            
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
