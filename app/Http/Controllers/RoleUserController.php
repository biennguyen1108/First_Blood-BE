<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RoleUser;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    public function store(Request $request){
        $role_user = RoleUser::create($request->all());
        return $this->commonResponse($role_user,'create successfully',200);
    }
}
