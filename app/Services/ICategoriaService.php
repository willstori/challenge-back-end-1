<?php

namespace App\Services;

interface ICategoriaService
{
    public function list();

    public function get(int $id);

    public function videos(int $id);

    public function store(array $requestData);

    public function update(array $requestData, int $id);

    public function destroy(int $id);
}
