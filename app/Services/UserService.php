<?php

namespace App\Services;

use App\Models\User;

interface UserService {
    function findAll();
    function findById(string $id);
    function findByUsername(string $username);
    function findByEmail(string $email);
    function create(User $user);
    function update(string $id, User $user);
    function remove(string $id);
}
