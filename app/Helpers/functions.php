<?php

if(!function_exists('hasValue'))
{
    function hasValue($data, $fied, $model){

        
        if(is_array($data)){
            // $data_implode = implode("','", $data);
            // $fied_implode = implode("','", $fied);
            // $model::where();
            
            foreach ($data as $key => $value) {
                
                $model->where($fied[$key], $value);
            }
            $model->where('pass', 1);
            dd($model->get());

        }else{
            return response()->json($model::where($fied, $data)->get());
        }
        
        // dd("'".$data_implode."'","'".$fied_implode."'");
        // $model = new $model;

        // return $this->model->where(['chats_id' => $chat_id, 'read' => 0])->get();
    }
}
