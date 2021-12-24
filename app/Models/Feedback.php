<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_from',
        'user_to',
        'type',
        'project_id',
        'professionalism',
        'communication',
        'payment',
        'clarity_spec',
        'emp',
        'on_time',
        'on_budget',
        'comments',
        'status',
    ];

    public static function isExist($user_from, $type, $project_id)
    {
        return Feedback::where('user_from', $user_from)->where('type', $type)->where('project_id', $project_id)->count();
    }

    public static function isBothExist($project_id)
    {
        $feedback = Feedback::where('project_id', $project_id)->count();
        if ($feedback > 1) {
            return true;
        } else {
            return false;
        }
    }

    public static function reviews($user)
    {
        return Feedback::where('user_to', $user)->count();
    }
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'project_id');
    }
}
