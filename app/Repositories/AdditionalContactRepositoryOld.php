private $model;

public function __construct(AdditionalContact $model)
{
    $this->model = $model;
}

public function getAdditionalContacts($id){

    return $this->model::where('contact_id', $id)
                        ->orderBy('created_at', 'asc')
                        ->get();
                        
}

public function create($request){

    try{
        DB::beginTransaction();
        
        $this->model->contact_id  = trim($request['contact_id']);
        $this->model->email  = trim($request['email']);
        $this->model->telephone     = trim($request['telephone']);
        $this->model->cell_phone     = trim($request['cell_phone']);

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

public function update($request, $id){

    try{
        DB::beginTransaction();
        $model = $this->model->find($id);

        $model->email      = $request['email'];
        $model->telephone      = $request['telephone'];
        $model->cell_phone      = $request['cell_phone'];
        
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