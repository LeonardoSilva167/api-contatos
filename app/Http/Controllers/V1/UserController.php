<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Service do Controller
     *
     * @var service
     */
    private $userService;

    /**
     * construtor do controller
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param integer $limit
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return response()->json($this->userService->getAll(), 200);
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
        try {
            return response()->json($this->userService->create($request), 200);
        }catch (\Exception $ex){
            return response()->json(['error' => true,'message' => $ex->getMessage()], $ex->getCode());
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
            return response()->json($this->userService->getUserData($id), 200);
        }catch (\Exception $ex){
            return response()->json(['error' => true,'message' => $ex->getMessage()], $ex->getCode());
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
            return response()->json($this->userService->update($request, $id), 200);
        }catch (\Exception $ex){
            return response()->json(['error' => true,'message' => $ex->getMessage()], $ex->getCode());
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
            return response()->json($this->userService->delete($id), 200);
        }catch (\Exception $ex){
            return response()->json(['error' => true,'message' => $ex->getMessage()], $ex->getCode());
        }
    }
}
