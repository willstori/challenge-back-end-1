<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;

class CategoriaTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function testCadastroDeCategoria()
    {
        $categoriaRequest = [
            'titulo' => 'cat_' . Str::random(14),
            'cor' => 'cat_' . Str::random(14)
        ];

        $response = $this->post('/categorias', $categoriaRequest);

        $response->assertCreated();
    }

    public function testCadastroDeCategoriaVazia()
    {
        $categoriaRequest = [
            'titulo' => "",
            'cor' => ""
        ];

        $response = $this->post('/categorias', $categoriaRequest);

        $response->assertUnprocessable();
    }

    public function testListagemDeCategorias()
    {
        $response = $this->get('/categorias');

        $response->assertOk();
    }

    public function testListagemDeCategoriaPorId()
    {
        $lastCategoria = Categoria::all()->last();

        $response = $this->get('/categorias/'. $lastCategoria->id);

        $response->assertOk();
    }

    public function testListagemDeCategoriaPorIdInexistente()
    {
        $response = $this->get('/categorias/-1');

        $response->assertNotFound();
    }

    public function testListagemDeVideosdaCategoria()
    {
        $lastCategoria = Categoria::all()->last();

        Video::create([
            'categoriaId' => 1,
            'titulo' => "Vid_" . Str::random(14),
            'descricao' => "Vid_" . Str::random(14),
            'url' => "http://video-url.com"
        ]);

        $response = $this->get('/categorias/'.$lastCategoria->id.'/videos');

        $response->assertOk();
    }

    public function testAlteracaoDeCategoria()
    {
        $lastCategoria = Categoria::all()->last();

        $categoriaRequest = [
            'titulo' => $lastCategoria->titulo . '_alterado',
            'cor' => $lastCategoria->cor . '_alterado'
        ];

        $response = $this->put('/categorias/' . $lastCategoria->id, $categoriaRequest);

        $response->assertOk();
    }

    public function testAlteracaoDeCategoriaVazia()
    {
        $lastCategoria = Categoria::all()->last();

        $categoriaRequest = [
            'titulo' => "",
            'cor' => ""
        ];

        $response = $this->put('/categorias/' . $lastCategoria->id, $categoriaRequest);

        $response->assertUnprocessable();
    }

    public function testAlteracaoDeCategoriaInexistente()
    {
        $lastCategoria = Categoria::all()->last();

        $categoriaRequest = [
            'titulo' => $lastCategoria->titulo . '_alterado',
            'cor' => $lastCategoria->cor . '_alterado'
        ];

        $response = $this->put('/categorias/-1', $categoriaRequest);

        $response->assertNotFound();
    }

    public function testExclusaoDeCategoria()
    {
        $lastCategoria = Categoria::all()->last();

        $response = $this->delete('/categorias/' . $lastCategoria->id);

        $response->assertOk();
    }

    public function testExclusaoDeCategoriaInexistente()
    {
        $response = $this->delete('/categorias/-1');

        $response->assertNotFound();
    }
}
