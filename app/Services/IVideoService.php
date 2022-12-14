<?php

namespace App\Services;

interface IVideoService
{
    public function list(string $search = "");

    public function get(int $id);

    public function store(array $requestData);

    public function update(array $requestData, int $id);

    public function destroy(int $id);
}
