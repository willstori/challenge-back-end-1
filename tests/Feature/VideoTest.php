<?php

namespace Tests\Feature;

use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VideoTest extends TestCase
{
    public function testCadastroDeVideo()
    {
        $videoRequest = [
            'titulo' => "Vídeo 1",
            'descricao' => "Teste de cadastro de vídeo.",
            'url' => "https://youtu.be/31ljFqO6kZQ"
        ];

        $response = $this->post('/videos', $videoRequest);

        $response->assertCreated();
    }

    public function testCadastroDeVideoVazio()
    {
        $videoRequest = [
            'titulo' => "",
            'descricao' => "",
            'url' => ""
        ];

        $response = $this->post('/videos', $videoRequest);

        $response->assertUnprocessable();
    }

    public function testListagemDeVideos()
    {
        $response = $this->get('/videos');

        $response->assertOk();
    }

    public function testListagemDeVideoPorId()
    {
        $lastVideo = Video::all()->last();

        $response = $this->get('/videos/' . $lastVideo->id);

        $response->assertOk();
    }

    public function testListagemDeVideoPorIdInexistente()
    {
        $response = $this->get('/videos/-1');

        $response->assertNotFound();
    }

    public function testAlteracaoDeVideo()
    {
        $lastVideo = Video::all()->last();

        $videoRequest = [
            'titulo' => "Vídeo 2 Alterado",
            'descricao' => "Teste de cadastro de vídeo. Alterado",
            'url' => "https://youtu.be/31ljFqO6kZQ"
        ];

        $response = $this->put('/videos/' . $lastVideo->id, $videoRequest);

        $response->assertOk();
    }

    public function testAlteracaoDeVideoVazio()
    {
        $lastVideo = Video::all()->last();

        $videoRequest = [
            'titulo' => "",
            'descricao' => "",
            'url' => ""
        ];

        $response = $this->put('/videos/' . $lastVideo->id, $videoRequest);

        $response->assertUnprocessable();
    }

    public function testAlteracaoDeVideoInexistente()
    {
        $videoRequest = [
            'titulo' => "Vídeo 2 Alterado",
            'descricao' => "Teste de cadastro de vídeo. Alterado",
            'url' => "https://youtu.be/31ljFqO6kZQ"
        ];

        $response = $this->put('/videos/-1', $videoRequest);

        $response->assertNotFound();
    }

    public function testExclusaoDeVideo()
    {
        $lastVideo = Video::all()->last();

        $response = $this->delete('/videos/' . $lastVideo->id);

        $response->assertOk();
    }

    public function testExclusaoDeVideoInexistente()
    {
        $response = $this->delete('/videos/-1');

        $response->assertNotFound();
    }
}
