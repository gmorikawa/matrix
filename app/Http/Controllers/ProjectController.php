<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Repository;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function getByOwner(Request $request, string $owner_id)
    {
        return Project::all()
            ->where("owner_id", $owner_id);
    }

    public function getRepositories(Request $request, string $owner_id, string $project_id)
    {
        return Repository::all()
            ->where("owner_id", $owner_id)
            ->where("project_id", $project_id);
    }


    public function getById(Request $request, string $owner_id, string $id)
    {
        return Project::all()
            ->where("owner_id", $owner_id)
            ->where("id", $id)
            ->first();
    }

    public function insert(Request $request, string $owner_id)
    {
        $newProject = new Project([
            "name" => $request->input("name"),
            "description" => $request->input("description"),
            "owner_id" => $owner_id,
        ]);

        $newProject->save();

        return $newProject;
    }

    public function update(Request $request, string $owner_id, string $id)
    {
        $project = Project::all()
            ->where("owner_id", $owner_id)
            ->where("id", $id)
            ->first();

        if ($project) {
            $project->name = $request->input("name");
            $project->description = $request->input("description");
        }

        $project->save();

        return $project;
    }

    public function remove(Request $request, string $owner_id, string $id)
    {
        $project = Project::all()
            ->where("owner_id", $owner_id)
            ->where("id", $id)
            ->first();

        if ($project) {
            $repositories = Repository::all()
                ->where("owner_id", $owner_id)
                ->where("project_id", $id);

            foreach ($repositories as $repository) {
                $repository->delete();
            }

            return $project->delete();
        }

        return $project;
    }
}
