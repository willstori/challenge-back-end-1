<?php

namespace App\Services;

use App\Models\User;
use App\Services\IUserService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService implements IUserService
{
    public function store(array $requestData)
    {
        $user = new User();

        $user->name = $requestData['nome'];
        $user->email = $requestData['email'];
        $user->password = Hash::make($requestData['senha']);
        $token = Str::random(80);
        $user->api_token = hash('sha256', $token);

        $user->save();

        return [
            'user' => [
                'nome' => $user->name,
                'email' => $user->email,
                'senha' => $requestData['senha'],
                'token' => $token
            ],
            'status' => 201
        ];
    }

    public function update(array $requestData, int $id)
    {
        $user = User::find($id);

        if ($user == null) {
            return [
                'user' => null,
                'status' => 404
            ];
        }

        $user->name = $requestData['nome'];
        $user->email = $requestData['email'];

        $user->update();

        return [
            'user' => $user,
            'status' => 200
        ];
    }

    public function updatePassword(array $requestData, int $id)
    {
        $user = User::find($id);

        if ($user == null) {
            return [
                'user' => null,
                'status' => 404
            ];
        }

        $user->password = Hash::make($requestData['senha']);
        $user->email = $requestData['email'];

        $user->update();

        return [
            'user' => [
                'nome' => $user->name,
                'email' => $user->email,
                'senha' => $requestData['senha']
            ],
            'status' => 200
        ];
    }

    public function updateToken(int $id)
    {
        $user = User::find($id);

        if ($user == null) {
            return [
                'user' => null,
                'status' => 404
            ];
        }

        $token = Str::random(80);
        $user->api_token = hash('sha256', $token);

        $user->update();

        return [
            'user' => [
                'token' => $token
            ],
            'status' => 200
        ];
    }

    public function destroy(int $id)
    {
        $user = User::find($id);

        if ($user == null) {
            return [
                'mensagem' => "Usuário não encontrado.",
                'status' => 404
            ];
        }

        $user->delete();

        return [
            'mensagem' => "Usuário removido com sucesso!",
            'status' => 200
        ];
    }
}
