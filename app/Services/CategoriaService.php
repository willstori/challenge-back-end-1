<?php

namespace App\Services;

use App\Models\Categoria;
use App\Services\ICategoriaService;

class CategoriaService implements ICategoriaService
{
    public function list()
    {
        $categorias = Categoria::all();

        return [
            'categorias' => $categorias,
            'status' => 200
        ];
    }

    public function get(int $id)
    {
        $categoria = Categoria::with(['videos'])->find($id);

        if ($categoria == null) {

            return [
                'categoria' => null,
                'status' => 404
            ];
        }

        return [
            'categoria' => $categoria,
            'status' => 200
        ];
    }

    public function videos(int $id)
    {
        $categoria = Categoria::with(['videos'])->find($id);

        if ($categoria == null) {

            return [
                'videos' => null,
                'status' => 404
            ];
        }

        return [
            'videos' => $categoria->videos,
            'status' => 200
        ];
    }

    public function store(array $requestData)
    {
        $categoria = new Categoria();

        $categoria->fill($requestData);

        $categoria->save();

        return [
            'categoria' => $categoria,
            'status' => 201
        ];
    }

    public function update(array $requestData, int $id)
    {
        $categoria = Categoria::find($id);

        if ($categoria == null) {
            return [
                'categoria' => null,
                'status' => 404
            ];
        }

        $categoria->update($requestData);

        return [
            'categoria' => $categoria,
            'status' => 200
        ];
    }

    public function destroy(int $id)
    {
        $categoria = Categoria::find($id);

        if ($categoria == null) {
            return [
                'mensagem' => "Categoria não encontrada.",
                'status' => 404
            ];
        }

        $categoria->delete();

        return [
            'mensagem' => "Categoria removida com sucesso!",
            'status' => 200
        ];
    }
}
