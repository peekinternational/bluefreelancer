<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContestPublicForum extends Model
{
    use HasFactory;
    protected $fillable = [
        'contest_id',
        'user_id',
        'message'
    ];

}
