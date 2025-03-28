<?php

namespace App\Services;

use App\Models\User;
use Exception;

interface UserService {
    function findAll();
    function findById(string $id);
    function findByUsername(string $username);
    function findByEmail(string $email);
    function create(User $user);
    function update(string $id, User $user);
    function remove(string $id);
}

class UserServiceImpl implements UserService
{
    public function findAll()
    {
        return User::all();
    }

    public function findById(string $id)
    {
        return User::find($id);
    }

    public function findByUsername(string $username)
    {
        return User::where("username", $username)
            ->first();
    }

    public function findByEmail(string $email)
    {
        return User::where("email", $email)
            ->first();
    }

    public function create(User $user)
    {
        if (!$this->isUsernameUnique($user->username)) {
            throw new Exception("Username is already registered.");
        }

        if (!$this->isEmailUnique($user->email)) {
            throw new Exception("Email is already registered.");
        }

        $user->save();

        return $user;
    }

    public function update(string $id, User $user)
    {
        if (!$this->isUsernameUnique($user->username)) {
            throw new Exception("Username is already registered.");
        }

        if (!$this->isEmailUnique($user->email)) {
            throw new Exception("Email is already registered.");
        }

        $entity = $this->findById($id);

        if ($user) {
            $entity->name = $user->name;
            $entity->email = $user->email;
            $entity->username = $user->username;
        }

        $entity->save();

        return $entity;
    }

    public function remove(string $id)
    {
        return User::destroy($id);
    }

    private function isUsernameUnique(string $username, string $ignoreId = ""): bool
    {
        $user = $this->findByUsername($username);

        return is_null($user) || (!is_null($user) && $user->id === $ignoreId);
    }

    private function isEmailUnique(string $email, string $ignoreId = ""): bool
    {
        $user = $this->findByEmail($email);

        return is_null($user) || (!is_null($user) && $user->id === $ignoreId);
    }
}
