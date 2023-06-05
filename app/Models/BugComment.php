<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BugComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'bug_id',
        'commenter',
        'comment',
    ];

    public function bug()
    {
        return $this->belongsTo(Bug::class);
    }
}
