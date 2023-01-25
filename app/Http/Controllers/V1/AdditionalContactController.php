<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdditionalContactController extends Controller
{
    /**
     * Service do Controller
     *
     * @var service
     */
    private $additionalContactService;

    /**
     * construtor do controller
     *
     * @param AdditionalContactService $additionalContactService
     */
    public function __construct(AdditionalContactService $additionalContactService){
        $this->additionalContactService = $additionalContactService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param integer $limit
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index($limit = 0,Request $request)
    {
        try {
            return response()->json($this->additionalContactService->list($limit,$request), 200);
        }catch (\Exception $ex){
            return response()->json(['error' => true,'message' => $ex->getMessage()], $ex->getCode());
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
            return response()->json($this->additionalContactService->delete($id), 200);
        }catch (\Exception $ex){
            return response()->json(['error' => true,'message' => $ex->getMessage()], $ex->getCode());
        }
    }
}
