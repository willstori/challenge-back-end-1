<?php

namespace App\Services;

use App\Models\Video;
use App\Services\IVideoService;
use Illuminate\Http\Request;

class VideoService implements IVideoService
{
    public function list()
    {
        $videos = Video::all();

        return [
            'videos' => $videos,
            'status' => 200
        ];
    }

    public function get(int $id)
    {
        $video = Video::find($id);

        if ($video == null) {

            return [
                'video' => null,
                'status' => 404
            ];
        }

        return [
            'video' => $video,
            'status' => 200
        ];
    }

    public function store(Request $request)
    {
        $video = $request->all();

        Video::create($video);

        return [
            'video' => $video,
            'status' => 201
        ];
    }

    public function update(Request $request, $id)
    {
        $video = Video::find($id);

        if ($video == null) {
            return [
                'video' => null,
                'status' => 404
            ];
        }

        $video->update($request->all());

        return [
            'video' => $video,
            'status' => 200
        ];
    }

    public function destroy($id)
    {
        $video = Video::find($id);

        if ($video == null) {
            return [
                'mensagem' => "Vídeo não encontrado.",
                'status' => 404
            ];
        }

        $video->delete();

        return [
            'mensagem' => "Vídeo removido com sucesso!",
            'status' => 200
        ];
    }
}
