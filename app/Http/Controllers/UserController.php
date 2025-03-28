<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $service
    ) {}

    public function getAll(Request $request)
    {
        return $this->service->findAll();
    }

    public function getById(Request $request, string $id)
    {
        return $this->service->findById($id);
    }

    public function create(Request $request)
    {
        $user = new User([
            "name" => $request->input("name"),
            "email" => $request->input("email"),
            "username" => $request->input("username"),
            "password" => $request->input("password")
        ]);

        return $this->service->create($user);
    }

    public function update(Request $request, string $id)
    {
        $user = new User([
            "name" => $request->input("name"),
            "email" => $request->input("email"),
            "username" => $request->input("username")
        ]);

        return $this->service->update($id, $user);
    }

    public function remove(Request $request, string $id)
    {
        return $this->service->remove($id);
    }
}
