<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;

class VideoTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function testCadastroDeVideo()
    {
        $lastCategoria = Categoria::all()->last();

        $videoRequest = [
            'categoriaId' => $lastCategoria->id,
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
            'categoriaId' => "",
            'titulo' => "",
            'descricao' => "",
            'url' => ""
        ];

        $response = $this->post('/videos', $videoRequest);

        $response->assertUnprocessable();
    }

    public function testListagemDeVideos()
    {
        $lastCategoria = Categoria::all()->last();

        Video::create([
            'categoriaId' => $lastCategoria->id,
            'titulo' => 'Vid_' . Str::random(14),
            'descricao' => 'Vid_' . Str::random(14),
            'url' => 'http://video-url.com',
        ]);

        $response = $this->get('/videos');

        $response->assertOk();
    }

    public function testListagemDeVideoPorId()
    {
        $lastCategoria = Categoria::all()->last();

        $video = Video::create([
            'categoriaId' => $lastCategoria->id,
            'titulo' => 'Vid_' . Str::random(14),
            'descricao' => 'Vid_' . Str::random(14),
            'url' => 'http://video-url.com',
        ]);

        $response = $this->get('/videos/' . $video->id);

        $response->assertOk();
    }

    public function testListagemDeVideoPorIdInexistente()
    {
        $response = $this->get('/videos/-1');

        $response->assertNotFound();
    }

    public function testAlteracaoDeVideo()
    {
        $lastCategoria = Categoria::all()->last();

        $video = Video::create([
            'categoriaId' => $lastCategoria->id,
            'titulo' => 'Vid_' . Str::random(14),
            'descricao' => 'Vid_' . Str::random(14),
            'url' => 'http://video-url.com',
        ]);

        $videoRequest = [
            'categoriaId' => $video->categoriaId,
            'titulo' => $video->titulo . "_alterado",
            'descricao' => $video->descricao . "_alterado",
            'url' => $video->url . "_alterado"
        ];

        $response = $this->put('/videos/' . $video->id, $videoRequest);

        $response->assertOk();
    }

    public function testAlteracaoDeVideoVazio()
    {
        $lastCategoria = Categoria::all()->last();

        $video = Video::create([
            'categoriaId' => $lastCategoria->id,
            'titulo' => 'Vid_' . Str::random(14),
            'descricao' => 'Vid_' . Str::random(14),
            'url' => 'http://video-url.com',
        ]);

        $videoRequest = [
            'categoriaId' => "",
            'titulo' => "",
            'descricao' => "",
            'url' => ""
        ];

        $response = $this->put('/videos/' . $video->id, $videoRequest);

        $response->assertUnprocessable();
    }

    public function testAlteracaoDeVideoInexistente()
    {
        $lastCategoria = Categoria::all()->last();

        $video = Video::create([
            'categoriaId' => $lastCategoria->id,
            'titulo' => 'Vid_' . Str::random(14),
            'descricao' => 'Vid_' . Str::random(14),
            'url' => 'http://video-url.com',
        ]);

        $videoRequest = [
            'categoriaId' => $video->categoriaId,
            'titulo' => $video->titulo,
            'descricao' => $video->descricao,
            'url' => $video->url
        ];

        $response = $this->put('/videos/-1', $videoRequest);

        $response->assertNotFound();
    }

    public function testExclusaoDeVideo()
    {
        $lastCategoria = Categoria::all()->last();

        $video = Video::create([
            'categoriaId' => $lastCategoria->id,
            'titulo' => 'Vid_' . Str::random(14),
            'descricao' => 'Vid_' . Str::random(14),
            'url' => 'http://video-url.com',
        ]);

        $response = $this->delete('/videos/' . $video->id);

        $response->assertOk();
    }

    public function testExclusaoDeVideoInexistente()
    {
        $response = $this->delete('/videos/-1');

        $response->assertNotFound();
    }
}
