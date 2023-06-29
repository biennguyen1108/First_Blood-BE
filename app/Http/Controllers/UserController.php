<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Http\Requests\UserRequest;
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

    public function store(UserRequest $userrequest)
    {
        $userrequest['password'] = Hash::make($userrequest->password);

        $user = User::create($userrequest->all());

        return $this->commonResponse($user, "", 200);
    }

    public function update(UserUpdateRequest $userupdaterequest, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->commonResponse($userupdaterequest,"User not found",200);
        }
        User::where('id',$id)->update($userupdaterequest->all());

        return  $this->commonResponse($userupdaterequest->all());
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
}
