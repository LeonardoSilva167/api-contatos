<?php

namespace App\Repositories;

use App\Exceptions\Message;
use App\Models\Contact;
use App\Repositories\Contracts\ContactRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ContactRepository implements extends BaseRepository  ContactRepositoryInterface
{
    private $model;

    public function __construct(Contact $model)
    {
        $this->model = new $model;
    }

    public function getAll(){
        return $this->model->all();
    }

    public function create($request){

        try{
            DB::beginTransaction();
            
            $this->model->name      = trim($request->name);
            $this->model->email  = trim($request->email);
            $this->model->telephone     = trim($request->telephone);
            $this->model->cell_phone     = trim($request->cell_phone);

            DB::commit();

            if(!$this->model->save()){
                return ['error' => true,'data'=> null,'state' => Message::ERRO, 'message' => throw new Exception()];
                // return ['error' => true,'data'=> null,'state' => Message::ERRO, 'message' => Message::MSG_ALGO_ERRADO];
            }
            
            return ['error' => false,'data'=> $this->model,'state' => Message::SUCESSO, 'message' => Message::MSG_INSERIDO_SUCESSO];


        } catch (\Exception $e) {
            DB::rollback();
            return ['error' => true,'data'=> null,'state' => Message::ERRO, 'message' => "Erro, $e"];
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
            $model->email      = trim($request->email);
            $model->telephone      = trim($request->telephone);
            $model->cell_phone      = trim($request->cell_phone);
            
            if($model->save()){
                DB::commit();
                return ['error' => false,'data'=> $model,'state' => Message::SUCESSO, 'message' => Message::MSG_ALTERADO_SUCESSO];
            }
            
            return ['error' => true,'data'=> null,'state' => Message::ERRO, 'message' => Message::MSG_ALGO_ERRADO];

        } catch (\Exception $e) {
            DB::rollback();
            // throw $e;
            return ['error' => true,'data'=> null,'state' => Message::ERRO, 'message' => "Erro, $e"];
        }
    }

    public function delete($id){{

        try{
            DB::beginTransaction();
            $model = $this->model->find($id);
            
            if($model->delete()){
                DB::commit();
                return ['error' => false,'data'=> $model,'state' => Message::SUCESSO, 'message' => Message::MSG_REMOVIDO_SUCESSO];
            }

            return ['error' => true,'data'=> null,'state' => Message::ERRO, 'message' => Message::MSG_ALGO_ERRADO];

        } catch (\Exception $e) {
            DB::rollback();
            // throw $e;
            return ['error' => true,'data'=> null,'state' => Message::ERRO, 'message' => "Erro, $e"];
        }
    }}
 
}
