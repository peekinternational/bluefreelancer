<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'amount',
        'bid_id',
        'project_id',
        'user_id',
        'status',
    ];

    public static function getMilestoneCount($project_id, $user_id)
    {
        return Milestone::where('project_id', $project_id)->where('user_id', $user_id)->count();
    }
}
