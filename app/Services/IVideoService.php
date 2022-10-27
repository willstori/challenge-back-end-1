<?php

namespace App\Services;

use Illuminate\Http\Request;

interface IVideoService
{
    public function list();

    public function get(int $id);

    public function store(Request $request);

    public function update(Request $request, $id);

    public function destroy($id);
}
