<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\ProjectUser;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use  Carbon\Carbon;
class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return $this->commonResponse($users);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->commonResponse($user, "User not found", 401);
        }
        return $this->commonResponse($user);
    }
    public function getCurrentUser(){
        $current_user = auth()->user();
        return $this->commonResponse($current_user);
    }

    public function store(UserRequest $userrequest)
    {
        $userrequest['password'] = Hash::make($userrequest->password);
        $user = User::create($userrequest->all());
        if($user->fails()){
            return  $this->commonResponse([],"User Not Found",400);
        }
          return  $this->commonResponse($user,"",200);

    }

    public function update(UserRequest $userupdaterequest, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->commonResponse($userupdaterequest,"User not found",200);
        }
        $user->update($userupdaterequest->all());

        return  $this->commonResponse( $user );
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->commonResponse([], "User not found", 404);
        }

        $user->delete();

        return $this->commonResponse([], "User not found", 404);
    }

    public function getUserByProject($id){

        $member=ProjectUser::join('projects', 'project_users.project_id', '=', 'projects.id')
            ->join('users', 'project_users.user_id', '=', 'users.id')
            ->select(
                'users.id',
                'users.email',
            )->where('project_id',$id)->get();
        return $this->commonResponse($member);
    }
}
