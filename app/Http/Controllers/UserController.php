<?php

namespace App\Http\Controllers;

use App\Services\IUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => ['required', 'unique:users,name'],
            'email' => ['required', 'email'],
            'senha' => ['required']
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $response = $this->userService->store($request->all());

        return response()->json($response['user'], $response['status']);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => ['required', 'unique:users,name,'.$id],
            'email' => ['required', 'email']
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $response = $this->userService->update($request->all(), $id);

        return response()->json($response['user'], $response['status']);
    }

    public function updatePassword(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'senha' => ['required']
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $response = $this->userService->updatePassword($request->all(), $id);

        return response()->json($response['user'], $response['status']);
    }

    public function updateToken(Request $request, $id)
    {
        $response = $this->userService->updateToken($id);

        return response()->json($response['user'], $response['status']);
    }

    public function destroy($id)
    {
        $response = $this->userService->destroy($id);

        return response()->json($response['mensagem'], $response['status']);
    }
}
