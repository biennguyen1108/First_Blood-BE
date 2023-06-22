<?php

namespace App\Http\Controllers;

use App\Http\Requests\BugRequest;
use App\Models\Bug;
use Illuminate\Http\Request;

class BugController extends Controller
{
    public function index()
    {
        $bugs = Bug::all();
        return $this->commonResponse($bugs);
    }

    public function show($id)
    {
        $bug = Bug::find($id);
        if (!$bug) {
            return $this->commonResponse([],'Bug not found',401);
        }
        return $this->commonResponse($bug);
    }
    public function store(BugRequest $bugRequest)
    {
        $bug = Bug::create([$bugRequest->all()]);
        return response()->json($bug, 201);
    }

    public function update(Request $request, $id)
    {
        $bug = Bug::find($id);
        if (!$bug) {
            return response()->json(['message' => 'Bug not found'], 404);
        }

        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'category_id' => 'required|exists:bug_categories,id',
            'status_id' => 'required|exists:status,id',
            'priority_id' => 'required|exists:priority,id',
            'title' => 'required',
            'description' => 'required',
            'reporter_by' => 'required|exists:users,id',
            'assigned_to' => 'required|exists:users,id',
        ]);

        $bug->project_id = $request->input('project_id');
        $bug->category_id = $request->input('category_id');
        $bug->status_id = $request->input('status_id');
        $bug->priority_id = $request->input('priority_id');
        $bug->title = $request->input('title');
        $bug->description = $request->input('description');
        $bug->reporter_by = $request->input('reporter_by');
        $bug->assigned_to = $request->input('assigned_to');
        $bug->save();

        return response()->json($bug);
    }

    public function destroy($id)
    {
        $bug = Bug::find($id);
        if (!$bug) {
            return response()->json(['message' => 'Bug not found'], 404);
        }

        $bug->delete();

        return response()->json(['message' => 'Bug deleted']);
    }
}
