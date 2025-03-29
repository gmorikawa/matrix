<?php

namespace App\Services;

use App\Models\Repository;

interface RepositoryService
{
    function findById(string $id, string $owner_id);
    function findByOwner(string $owner_id);
    function findByName(string $name, string $owner_id);
    function create(Repository $repository);
    function update(string $id, Repository $repository);
    function remove(string $id, string $owner_id);
}
