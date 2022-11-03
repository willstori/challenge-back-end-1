<?php

namespace App\Http\Controllers;

use App\Services\ICategoriaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{
    private $categoriaService;

    public function __construct(ICategoriaService $categoriaService)
    {
        $this->categoriaService = $categoriaService;
    }

    public function index()
    {
        $response = $this->categoriaService->list();

        return response()->json($response['categorias'], $response['status']);
    }

    public function show($id)
    {
        $response = $this->categoriaService->get($id);

        return response()->json($response['categoria'], $response['status']);
    }

    public function videos($id)
    {
        $response = $this->categoriaService->videos($id);

        return response()->json($response['videos'], $response['status']);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => ['required', 'max:200', 'unique:categorias'],
            'cor' => ['required'],
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $response = $this->categoriaService->store($request->all());

        return response()->json($response['categoria'], $response['status']);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => ['required', 'max:200','unique:categorias,titulo,'.$id],
            'cor' => ['required']
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $response = $this->categoriaService->update($request->all(), $id);

        return response()->json($response['categoria'], $response['status']);
    }

    public function destroy($id)
    {
        $response = $this->categoriaService->destroy($id);

        return response()->json($response['mensagem'], $response['status']);
    }
}
