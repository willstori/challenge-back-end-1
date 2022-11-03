<?php

namespace App\Services;

use App\Models\Video;
use App\Services\IVideoService;

class VideoService implements IVideoService
{
    public const LIVRE = 1;

    public function list(string $search = null)
    {
        $query = Video::query();

        if(!empty($search)){
            $query->where('titulo', 'LIKE', '%'.$search.'%');
        }

        $videos = $query->get();

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

    public function store(array $requestData)
    {
        $video = new Video();

        $video->fill($requestData);

        if (!isset($requestData['categoriaId']) || empty($requestData['categoriaId'])) {
            $video->categoriaId = VideoService::LIVRE;
        }

        $video->save();

        return [
            'video' => $video,
            'status' => 201
        ];
    }

    public function update(array $requestData, int $id)
    {
        $video = Video::find($id);

        if ($video == null) {
            return [
                'video' => null,
                'status' => 404
            ];
        }

        $video->update($requestData);

        return [
            'video' => $video,
            'status' => 200
        ];
    }

    public function destroy(int $id)
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
