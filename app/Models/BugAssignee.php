<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BugAssignee extends Model
{
    use HasFactory;

    protected $fillable = [
        'bug_id',
        'user_id',
        'assigned_date',
        'resolved_date',
    ];

    public function bug()
    {
        return $this->belongsTo(Bug::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
