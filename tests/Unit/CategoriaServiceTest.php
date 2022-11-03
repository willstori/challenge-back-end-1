<?php

namespace Tests\Unit;

use App\Models\Categoria;
use App\Models\Video;
use App\Services\CategoriaService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;

class CategoriaServiceTest extends TestCase
{
    use RefreshDatabase;

    private CategoriaService $categoriaService;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->categoriaService = new CategoriaService();
    }

    public function testStore()
    {
        $requestData = [
            'titulo' => "Cat_" . Str::random(14),
            'cor' => "Cat_" . Str::random(14),
        ];

        $this->assertTrue(true);

        $response = $this->categoriaService->store($requestData);

        $this->assertEquals($requestData['titulo'], $response['categoria']->titulo);
        $this->assertEquals($requestData['cor'], $response['categoria']->cor);
        $this->assertEquals(201, $response['status']);
    }

    public function testList()
    {
        $response = $this->categoriaService->list();

        $this->assertCount(1, $response['categorias']);
        $this->assertEquals(200, $response['status']);
    }

    public function testGet()
    {
        $response = $this->categoriaService->get(1);

        $this->assertEquals('LIVRE', $response['categoria']['titulo']);
        $this->assertEquals('Azul', $response['categoria']['cor']);
        $this->assertEquals(200, $response['status']);
    }

    public function testVideos()
    {
        Video::create([
            'categoriaId' => 1,
            'titulo' => "Vid_" . Str::random(14),
            'descricao' => "Vid_" . "Vid_" . Str::random(14),
            'url' => "http://url-video.com"
        ]);

        $response = $this->categoriaService->videos(1);

        $this->assertCount(1, $response['videos']);
        $this->assertEquals(200, $response['status']);
    }

    public function  testUpdate()
    {
        $categoria = Categoria::create([
            'titulo' => "Cat_" . Str::random(14),
            'cor' => "Cat_" . Str::random(14),
        ]);

        $requestData = [
            'titulo' => $categoria['titulo'] . '_alterado',
            'cor' => $categoria['cor'] . '_alterado',
        ];

        $response = $this->categoriaService->update($requestData, $categoria->id);

        $this->assertEquals($requestData['titulo'], $response['categoria']['titulo']);
        $this->assertEquals($requestData['cor'], $response['categoria']['cor']);
        $this->assertEquals(200, $response['status']);
    }

    public function testDestroy()
    {
        $response = $this->categoriaService->destroy(1);

        $this->assertEquals(200, $response['status']);
    }
}
