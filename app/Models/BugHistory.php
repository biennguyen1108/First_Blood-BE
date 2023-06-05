<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BugHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'bug_id',
        'user_id',
        'action_id',
        'description',
        'performed_at',
    ];

    public function bug()
    {
        return $this->belongsTo(Bug::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function action()
    {
        return $this->belongsTo(Action::class);
    }
}
