<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContestHandover extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'contest_id',
        'user_id',
    ];
}
