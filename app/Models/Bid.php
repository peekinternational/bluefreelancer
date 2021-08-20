<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'user_id',
        'budget',
        'day',
        'proposal',
        'status',
    ];

    public static function getBids($id)
    {
        return Bid::where('project_id', $id)->get();
    }

    public static function getBidAvgAmt($id)
    {
        return Bid::where('project_id', $id)->avg('budget');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'project_id');
    }

    public function milestones()
    {
        return $this->hasMany(Milestone::class);
    }

    public static function isBidAvailable($user_id, $project_id)
    {
        return Bid::where('user_id', $user_id)->where('project_id', $project_id)->first();
    }
}
