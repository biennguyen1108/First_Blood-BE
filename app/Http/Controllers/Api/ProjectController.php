<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return response()->json($projects);
    }

    public function show($id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }
        return response()->json($project);
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required',
            'description' => 'required',
            'created_by' => 'required|exists:users,id',
        ]);

        $project = Project::create([
            'project_name' => $request->input('project_name'),
            'description' => $request->input('description'),
            'created_by' => $request->input('created_by'),
        ]);

        return response()->json($project, 201);
    }

    public function update(Request $request, $id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $request->validate([
            'project_name' => 'required',
            'description' => 'required',
            'created_by' => 'required|exists:users,id',
        ]);

        $project->project_name = $request->input('project_name');
        $project->description = $request->input('description');
        $project->created_by = $request->input('created_by');
        $project->save();

        return response()->json($project);
    }

    public function destroy($id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $project->delete();

        return response()->json(['message' => 'Project deleted']);
    }
}
