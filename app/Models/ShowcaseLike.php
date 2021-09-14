<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShowcaseLike extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'showcase_id'
    ];
    // public function getLikes($showcase_id, user_id)
    // {
        
    // }
}
