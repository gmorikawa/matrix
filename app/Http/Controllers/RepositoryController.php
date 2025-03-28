<?php

namespace App\Http\Controllers;

use App\Models\Repository;
use App\Services\RepositoryService;
use Illuminate\Http\Request;

class RepositoryController extends Controller
{
    public function __construct(
        private readonly RepositoryService $service
    ) {}

    public function getByOwner(Request $request, string $owner_id)
    {
        return $this->service->findByOwner($owner_id);
    }

    // public function getByProject(Request $request, string $owner_id, string $project_id)
    // {
    //     return Repository::all()
    //         ->where("owner_id", $owner_id)
    //         ->where("project_id", $project_id);
    // }

    public function getById(Request $request, string $owner_id, string $id)
    {
        return $this->service->findById($id, $owner_id);
    }

    public function create(Request $request, string $owner_id)
    {
        $repository = new Repository([
            "name" => $request->input("name"),
            "description" => $request->input("description"),
            "owner_id" => $owner_id,
            "project_id" => $request->input("project_id")
        ]);

        return $this->service->create($repository);
    }

    public function update(Request $request, string $owner_id, string $id)
    {
        $repository = new Repository([
            "name" => $request->input("name"),
            "description" => $request->input("description"),
            "owner_id" => $request->input("owner_id"),
            "project_id" => $request->input("project_id")
        ]);

        return $this->service->update($id, $repository);
    }

    public function remove(Request $request, string $owner_id, string $id)
    {
        return $this->service->remove($id, $owner_id);
    }
}
