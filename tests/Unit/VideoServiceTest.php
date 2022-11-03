<?php

namespace Tests\Unit;

use App\Models\Video;
use App\Services\VideoService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;

class VideoServiceTest extends TestCase
{
    use RefreshDatabase;

    private VideoService $videoService;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->videoService = new VideoService();
    }

    public function testStore()
    {
        $requestData = [
            'categoriaId' => 1,
            'titulo' => "Vid_" . Str::random(14),
            'descricao' => "Vid_" . Str::random(14),
            'url' => "http://video-url.com"
        ];

        $response = $this->videoService->store($requestData);

        $this->assertEquals(201, $response['status']);
        $this->assertEquals($requestData['categoriaId'], $response['video']['categoriaId']);
        $this->assertEquals($requestData['titulo'], $response['video']['titulo']);
        $this->assertEquals($requestData['descricao'], $response['video']['descricao']);
        $this->assertEquals($requestData['url'], $response['video']['url']);
    }

    public function testList()
    {
        Video::create([
            'categoriaId' => 1,
            'titulo' => "Vid_" . Str::random(14),
            'descricao' => "Vid_" . Str::random(14),
            'url' => "http://video-url.com"
        ]);

        $response = $this->videoService->list();

        $this->assertEquals(200, $response['status']);
        $this->assertCount(1, $response['videos']);
    }

    public function testListComSearch()
    {
        $video = Video::create([
            'categoriaId' => 1,
            'titulo' => "Vid_" . Str::random(14),
            'descricao' => "Vid_" . Str::random(14),
            'url' => "http://video-url.com"
        ]);

        $response = $this->videoService->list($video->titulo);

        $this->assertEquals(200, $response['status']);
        $this->assertCount(1, $response['videos']);
    }

    public function testGet()
    {
        $video = Video::create([
            'categoriaId' => 1,
            'titulo' => "Vid_" . Str::random(14),
            'descricao' => "Vid_" . Str::random(14),
            'url' => "http://video-url.com"
        ]);

        $response = $this->videoService->get(1);

        $this->assertEquals(200, $response['status']);
        $this->assertEquals($video->categoriaId, $response['video']['categoriaId']);
        $this->assertEquals($video->titulo, $response['video']['titulo']);
        $this->assertEquals($video->descricao, $response['video']['descricao']);
        $this->assertEquals($video->url, $response['video']['url']);
    }

    public function testUpdate()
    {
        $video = Video::create([
            'categoriaId' => 1,
            'titulo' => "Vid_" . Str::random(14),
            'descricao' => "Vid_" . Str::random(14),
            'url' => "http://video-url.com"
        ]);

        $requestData = [
            'categoriaId' => $video->categoriaId,
            'titulo' => $video->titulo . '_alterado',
            'descricao' => $video->descricao . '_alterado',
            'url' => $video->url . '_alterado'
        ];

        $response = $this->videoService->update($requestData, $video->id);

        $this->assertEquals(200, $response['status']);
        $this->assertEquals($requestData['categoriaId'], $response['video']['categoriaId']);
        $this->assertEquals($requestData['titulo'], $response['video']['titulo']);
        $this->assertEquals($requestData['descricao'], $response['video']['descricao']);
        $this->assertEquals($requestData['url'], $response['video']['url']);
    }

    public function testDestroy()
    {
        $video = Video::create([
            'categoriaId' => 1,
            'titulo' => "Vid_" . Str::random(14),
            'descricao' => "Vid_" . Str::random(14),
            'url' => "http://video-url.com"
        ]);

        $response = $this->videoService->destroy($video->id);

        $videos = Video::all();

        $this->assertEquals(200, $response['status']);
        $this->assertCount(0, $videos);
    }
}
