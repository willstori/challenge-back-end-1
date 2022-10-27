<?php

namespace App\Http\Controllers;

use App\Services\IVideoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    private $videoService;

    public function __construct(IVideoService $videoService)
    {
        $this->videoService = $videoService;
    }

    public function index()
    {
        $response = $this->videoService->list();

        return response()->json($response['videos'], $response['status']);
    }

    public function show($id)
    {
        $response = $this->videoService->get($id);

        return response()->json($response['video'], $response['status']);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => ['required'],
            'descricao' => ['required'],
            'url' => ['required', 'url']
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $response = $this->videoService->store($request);

        return response()->json($response['video'], $response['status']);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => ['required'],
            'descricao' => ['required'],
            'url' => ['required', 'url']
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $response = $this->videoService->update($request, $id);

        return response()->json($response['video'], $response['status']);
    }

    public function destroy($id)
    {
        $response = $this->videoService->destroy($id);

        return response()->json($response['mensagem'], $response['status']);
    }
}
