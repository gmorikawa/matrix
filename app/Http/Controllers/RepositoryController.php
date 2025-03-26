<?php

namespace App\Http\Controllers;

use App\Models\Repository;
use Illuminate\Http\Request;

class RepositoryController extends Controller
{
    public function getByOwner(Request $request, string $owner_id)
    {
        return Repository::all()
            ->where("owner_id", $owner_id);
    }

    public function getByProject(Request $request, string $owner_id, string $project_id)
    {
        return Repository::all()
            ->where("owner_id", $owner_id)
            ->where("project_id", $project_id);
    }

    public function getById(Request $request, string $owner_id, string $id)
    {
        return Repository::all()
            ->where("owner_id", $owner_id)
            ->where("id", $id)
            ->first();
    }

    public function insert(Request $request, string $owner_id)
    {
        $newRepository = new Repository([
            "name" => $request->input("name"),
            "description" => $request->input("description"),
            "owner_id" => $owner_id,
            "project_id" => $request->input("project_id")
        ]);

        $newRepository->save();

        return $newRepository;
    }

    public function update(Request $request, string $owner_id, string $id)
    {
        $repository = Repository::all()
            ->where("owner_id", $owner_id)
            ->where("id", $id)
            ->first();

        if ($repository) {
            $repository->name = $request->input("name");
            $repository->description = $request->input("description");
            $repository->project_id = $request->input("project_id");
        }

        $repository->save();

        return $repository;
    }

    public function remove(Request $request, string $owner_id, string $id)
    {
        $repository = Repository::all()
            ->where("owner_id", $owner_id)
            ->where("id", $id)
            ->first();

        if ($repository) {
            return $repository->delete();
        }

        return $repository;
    }
}
