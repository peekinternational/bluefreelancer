<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Showcase extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'cate',
        'currency',
        'amt',
        'img',
        'status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function showcaseLikes()
    {
        return $this->hasMany(ShowcaseLike::class);
    }
}
