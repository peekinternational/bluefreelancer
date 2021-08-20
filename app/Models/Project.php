<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'title',
        'description',
        'location',
        'image',
        'skills',
        'main_category',
        'sub_category',
        'currency',
        'rate_status',
        'fixed_rate',
        'hourly_rate',
        'min_budget',
        'max_budget',
        'status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bid()
    {
        return $this->belongsTo(Bid::class, 'project_id', 'project_id');
    }

    public function milestones()
    {
        return $this->hasMany(Milestone::class, 'project_id', 'project_id');
    }
}
