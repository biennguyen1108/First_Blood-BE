<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\ProjectUser;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return $this->commonResponse($projects);

    }

    public function show($id)
    {
        $project = Project::find($id);
        if (!$project) {
            return  $this->commonResponse($project,"Project not found",401);
        }
        return  $this->commonResponse($project);

    }

    public function store(ProjectRequest $projectrequest)
    {
        $data = $projectrequest->all();
        $data["create_by"] = auth()->user()->id;
        $project = Project::create($data);

        $project_user = new ProjectUser();
        $project_user->project_id = $project->id;
        $project_user->user_id = auth()->user()->id;
        $project_user->role = 1;
        $project_user->save();

        if($project->fails()){
            return  $this->commonResponse($project,"Project Not Found",400);
        }
    return  $this->commonResponse($project,"",200);
    }

    public function update(ProjectRequest $projectrequest, $id)
    {
        $projectrequest = Project::find($id);
        if (!$projectrequest) {
            return  $this->commonResponse($projectrequest,"Project not found",200);
        }
        Project::where('id',$id)->update($projectrequest->toArray());
        return  $this->commonResponse($projectrequest);
    }

    public function destroy($id)
    {
        $project = Project::find($id);
        if (!$project) {
            return $this->commonResponse([],"Project not found",404);
        }

        $project->delete();

        return $this->commonResponse([],"delete project",400);
    }

}
