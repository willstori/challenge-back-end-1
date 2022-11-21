<?php

namespace App\Services;

interface IUserService
{
    public function store(array $requestData);

    public function update(array $requestData, int $id);

    public function updatePassword(array $requestData, int $id);

    public function updateToken(int $id);

    public function destroy(int $id);
}
