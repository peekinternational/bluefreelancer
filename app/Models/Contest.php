<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use HasFactory;

    protected $fillable = [
        'contest_id',
        'title',
        'description',
        'main_category',
        'sub_category',
        'skills',
        'currency',
        'budget',
        'days',
        'file',
        'status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ContestPublicForums()
    {
        return $this->hasMany(ContestPublicForum::class, 'contest_id', 'contest_id');
    }

    public function ContestEntries()
    {
        return $this->hasMany(ContestEntry::class, 'contest_id', 'contest_id');
    }

    public function contestEntryCompleted()
    {
        return $this->belongsTo(ContestEntry::class, 'contest_id', 'contest_id')->with('user')->where('status', 2);
    }
}