<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'companyname',
        'summary',
        'started_at',
        'completion_at',
        'work_status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
