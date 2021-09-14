<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContestEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'detail',
        'file',
        'amount',
        'status',
        'contest_id',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contest()
    {
        return $this->belongsTo(Contest::class, 'contest_id', 'contest_id');
    }

    public function ContestEntries()
    {
        return $this->hasMany(ContestEntry::class, 'contest_id', 'contest_id');
    }
}
