<?php

namespace App\Http\Controllers\V1;

use App\Exceptions\Message;
use App\Http\Controllers\Controller;
use App\services\Contactservice;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    /**
     * service do Controller
     *
     * @var service
     */
    private $service;

    /**
     * construtor do controller
     *
     * @param Contactservice $service
     */
    public function __construct(Contactservice $service){
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index():JsonResponse
    {
        try {
            return response()->json($this->service->getAll(), 200);            
        }catch (\Exception $ex){
            return response()->json(['error' => true,'data'=> null,'state' => Message::ERRO,'message' => $ex->getMessage()], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        try {
            DB::beginTransaction();
            $result = $this->service->create($request);
            DB::commit();
            return response()->json($result, 200);            

        }catch (\Exception $ex){
            DB::rollback();
            return response()->json(['error' => true,'data'=> null,'state' => Message::ERRO,'message' => $ex->getMessage()], 404);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return response()->json($this->service->getAllCustom($id), 200);
        }catch (\Exception $ex){
            return response()->json(['error' => true,'data'=> null,'state' => Message::ERRO,'message' => $ex->getMessage()], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $result = $this->service->update($request, $id);
            DB::commit();
            return response()->json($result, 200);            

        }catch (\Exception $ex){
            DB::rollback();
            return response()->json(['error' => true,'data'=> null,'state' => Message::ERRO,'message' => $ex->getMessage()], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $result = $this->service->delete($id);
            DB::commit();
            return response()->json($result, 200);            

        }catch (\Exception $ex){
            DB::rollback();
            return response()->json(['error' => true,'data'=> null,'state' => Message::ERRO,'message' => $ex->getMessage()], 404);
        }
    }

    public function getCountContacts(){
        try {
            return response()->json($this->service->getCountContacts(), 200);            
        }catch (\Exception $ex){
            return response()->json(['error' => true,'data'=> null,'state' => Message::ERRO,'message' => $ex->getMessage()], 404);
        }
    }
}
