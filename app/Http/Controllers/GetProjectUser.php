<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectUser;

class GetProjectUser extends Controller
{
    public function index(){
        $current_user = auth()->user();
        $project1 = ProjectUser::where('user_id',$current_user->id)->get();

//        $project =  Project::select('projects.id', 'project_name', 'description', 'projects.created_at','create_by')
//        ->join('project_users', 'projects.id', '=', 'project_users.project_id')
//            ->where('user_id', $current_user->id)->get();
////        $project->user_email = $current_user->email;
        $project = Project::select('projects.id', 'project_name', 'description', 'projects.created_at', 'email as create_by_email')
            ->join('project_users', 'projects.id', '=', 'project_users.project_id')
            ->join('users', 'create_by', '=', 'users.id')
            ->where('project_users.user_id', $current_user->id)
            ->get();
        return $this->commonResponse($project);
    }
}
