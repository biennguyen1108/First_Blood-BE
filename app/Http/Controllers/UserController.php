<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

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
            return $this->commonResponse($user,"User not found",401);
        }
        return $this->commonResponse($user);
    }

    public function store(UserRequest $userrequest)
    {

        $user = User::create([
            'password'=> Hash::make($userrequest->password),
            'email' => $userrequest->email,
            'role' => $userrequest->role
        ]);
        return $this->commonResponse($user,"",200);
    }

    public function update(UserRequest $userrequest, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->commonResponse($userrequest,"User not found",200);
        }

        User::where('id',$id)->update($userrequest->toArray());
        return  $this->commonResponse($userrequest);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
         return $this->commonResponse([],"User not found",404);
        }

        $user->delete();

        return $this->commonResponse([],"User not found",404);
    }
}
