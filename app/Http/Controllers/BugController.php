<?php

namespace App\Http\Controllers;

use App\Http\Requests\BugRequest;
use App\Models\Bug;
use App\Models\BugSteps;
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
            return $this->commonResponse([], 'Bug not found', 401);
        }
        return $this->commonResponse($bug);
    }

    public function store(BugRequest $bugRequest)
    {
        $bug = Bug::create($bugRequest->all());
//        if ($bug->fails()) {
//            return $this->commonResponse([], "Bug Not Found", 400);
//        }
        return $this->commonResponse($bug, "", 200);
    }

    public function update(BugRequest $bugrequest, $id)
    {
        $bugrequest = Bug::find($id);
        if (!$bugrequest) {
            return $this->commonResponse([], "Bug not foundBug not found", 404);
        }
        Bug::where('id', $id)->update($bugrequest->toArray());

        return $this->commonResponse($bugrequest);
    }

    public function destroy($id)
    {
        $bug = Bug::find($id);
        if (!$bug) {
            return $this->commonResponse([], "Bug not foundBug not found", 404);
        }
        $bug->delete();

        return $this->commonResponse([], "delete bug", 400);
    }

//    public function BugByProject($id){
//        $bugs = Bug::join('projects', 'bugs.project_id', '=', 'projects.id')
//            ->join('bug_categories', 'bugs.category_id', '=', 'bug_categories.id')
//            ->join('status', 'bugs.status_id', '=', 'status.id')
//            ->join('priority', 'bugs.priority_id', '=', 'priority.id')
//            ->join('users AS reporter', 'bugs.reporter_by', '=', 'reporter.id')
//            ->join('users AS assigned_to', 'bugs.assigned_to', '=', 'assigned_to.id')
//            ->select(
//                'bugs.id',
//                'project_id',
//                'projects.project_name',
//                'category_id',
//                'bug_categories.category_name',
//                'status_id',
//                'status.status_name',
//                'priority_id',
//                'priority.priority_name',
//                'bugs.reporter_by',
//                'reporter.email AS reporter_email',
//                'bugs.assigned_to',
//                'assigned_to.email AS assigned_email'
//            )
//            ->where('projects.id', $id)
//                ->groupBy('bugs.id')
//            ->get();
//
//        return $this->commonResponse($bugs);
//    }
    public function BugByProject(Request $request, $id)
    {
        $nameLike = $request->input('name_like');

        $query = Bug::join('projects', 'bugs.project_id', '=', 'projects.id')
            ->join('bug_categories', 'bugs.category_id', '=', 'bug_categories.id')
            ->join('status', 'bugs.status_id', '=', 'status.id')
            ->join('priority', 'bugs.priority_id', '=', 'priority.id')
            ->join('users AS reporter', 'bugs.reporter_by', '=', 'reporter.id')
            ->join('users AS assigned_to', 'bugs.assigned_to', '=', 'assigned_to.id')
            ->select(
                'bugs.id',
                'project_id',
                'projects.project_name',
                'category_id',
                'bug_categories.category_name',
                'status_id',
                'status.status_name',
                'priority_id',
                'priority.priority_name',
                'bugs.reporter_by',
                'reporter.email AS reporter_email',
                'bugs.assigned_to',
                'assigned_to.email AS assigned_email'
            )
            ->where('projects.id', $id);

        if ($nameLike) {
            $query->where('status.status_name', 'like', "%{$nameLike}%");
        }

        $bugs = $query->groupBy('bugs.id')->get();

        return $this->commonResponse($bugs);
    }

    public function BugFilter(Request $request, $id)
    {
        $assigned = $request->query('assigned');
        $reporter = $request->query('reporter');
        $nameLike = $request->input('name_like');
        $status = $request->input('status');


        $query = Bug::join('projects', 'bugs.project_id', '=', 'projects.id')
            ->join('bug_categories', 'bugs.category_id', '=', 'bug_categories.id')
            ->join('status', 'bugs.status_id', '=', 'status.id')
            ->join('priority', 'bugs.priority_id', '=', 'priority.id')
            ->join('users AS reporter', 'bugs.reporter_by', '=', 'reporter.id')
            ->join('users AS assigned_to', 'bugs.assigned_to', '=', 'assigned_to.id')
            ->select(
                'bugs.id',
                'bugs.title',
                'bugs.description',
                'project_id',
                'projects.project_name',
                'category_id',
                'bug_categories.category_name',
                'status_id',
                'status.status_name',
                'priority_id',
                'priority.priority_name',
                'bugs.reporter_by',
                'reporter.email AS reporter_email',
                'bugs.assigned_to',
                'assigned_to.email AS assigned_email'
            )
            ->where('projects.id', $id);

        if ($assigned) {
            $query->where('assigned_to.email', $assigned);
        }

        if ($reporter) {
            $query->where('reporter.email', $reporter);
        }
        if ($nameLike) {
            $query->where('status.status_name', 'like', "%{$nameLike}%");
        }
        if ($status) {
            $query->where('status.status_name', $status);
        }

        $bugs = $query->groupBy('bugs.id')->get();

        return $this->commonResponse($bugs);
    }

    public function getStep($id){
       $steps = BugSteps::where('bug_id',$id)->get();

        return $this->commonResponse($steps);

    }

    public function editStatus(Request $request){

       $step = Bug::where('id', $request->id);
       $step->update(['status_id'=>$request->status]);

        return $this->commonResponse([],'thanh cong');

    }
}
