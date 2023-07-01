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
            if($bug->fails()){
                return  $this->commonResponse([],"Bug Not Found",400);
            }
        return  $this->commonResponse($bug,"",200);
    }

    public function update(BugRequest $bugrequest, $id)
    {
        $bugrequest= Bug::find($id);
        if (!$bugrequest) {
            return  $this->commonResponse([],"Bug not foundBug not found",404);
        }
        Bug::where('id',$id)->update($bugrequest->toArray());
        // $bugrequest->save();
        return $this->commonResponse($bugrequest);
    }

    public function destroy($id)
    {
        $bug = Bug::find($id);
        if (!$bug) {
            return $this->commonResponse([],"Bug not foundBug not found",404);
        }

        $bug->delete();

        return $this->commonResponse([],"delete bug",400);
    }
}
