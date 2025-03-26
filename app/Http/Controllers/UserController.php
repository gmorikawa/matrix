<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAll(Request $request)
    {
        return User::all();
    }

    public function getById(Request $request, string $id)
    {
        return User::all()->find($id);
    }

    public function insert(Request $request)
    {
        $newUser = new User([
            "name" => $request->input("name"),
            "email" => $request->input("email"),
            "password" => $request->input("password")
        ]);

        $newUser->save();

        return $newUser;
    }

    public function update(Request $request, string $id)
    {
        $user = User::all()->find($id);

        if ($user) {
            $user->name = $request->input("name");
            $user->email = $request->input("email");
        }

        $user->save();

        return $user;
    }

    public function remove(Request $request, string $id) {
        return User::destroy($id);
    }
}
