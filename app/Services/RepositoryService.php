<?php

namespace App\Services;

use App\Models\Repository;
use Exception;

interface RepositoryService
{
    function findById(string $id, string $owner_id);
    function findByOwner(string $owner_id);
    function findByName(string $name, string $owner_id);
    function create(Repository $repository);
    function update(string $id, Repository $repository);
    function remove(string $id, string $owner_id);
}

class RepositoryServiceImpl implements RepositoryService
{
    public function findById(string $id, string $owner_id)
    {
        return Repository::where("id", $id)
            ->where("owner_id", $owner_id)
            ->first();
    }

    public function findByOwner(string $owner_id)
    {
        return Repository::where("owner_id", $owner_id);
    }

    public function findByName(string $name, string $owner_id)
    {
        return Repository::where("name", $name)
            ->where("owner_id", $owner_id)
            ->first();
    }

    public function create(Repository $repository)
    {
        if (!$this->isNameUnique($repository->name, $repository->owner_id)) {
            throw new Exception("The repository name is not available.");
        }

        $repository->save();

        return $repository;
    }

    public function update(string $id, Repository $repository)
    {
        if (!$this->isNameUnique($repository->name, $repository->owner_id, $id)) {
            throw new Exception("The repository name is not available.");
        }

        $entity = $this->findById($id, $repository->owner_id);

        if ($entity) {
            $entity->name = $repository->name;
            $entity->description = $repository->description;
            $entity->project_id = $repository->project_id;
        }

        $entity->save();

        return $entity;
    }

    public function remove(string $id, string $owner_id)
    {
        $repository = Repository::all()
            ->where("owner_id", $owner_id)
            ->where("id", $id)
            ->first();

        if (!is_null($repository)) {
            return $repository->delete();
        } else {
            return null;
        }
    }

    private function isNameUnique(string $name, string $owner_id, string $ignoreId = "")
    {
        $repository = $this->findByName($name, $owner_id);

        return is_null($repository) || (!is_null($repository) && $repository->id === $ignoreId);
    }
}
