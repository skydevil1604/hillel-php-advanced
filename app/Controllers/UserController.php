<?php
namespace App\Controllers;

use Core\Controller;
class UserController extends Controller
{
    public function index(): array
    {
        return $this->response(body: [
            'users' => 'all'
        ]);
    }

    public function show($id): array
    {
        return $this->response(body: [
            'user' => 'show',
            'id' => $id
        ]);
    }

    public function store(): array
    {
        return $this->response(body: [
            'user' => 'added'
        ]);
    }

    public function edit(int $id): array
    {
        return $this->response(body: [
            'user' => 'update',
            'id' => $id
        ]);
    }

    public function destroy($id): array
    {
        return $this->response(body: [
            'user' => 'delete',
            'id' => $id
        ]);
    }
}