<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasFactory,HasApiTokens;

    protected $fillable = [

        'password',
        'email',
        'role'
    ];
    protected $hidden = ['password'];

    public function User()
    {
        return $this->hasOne(Project::class);
    }

}
