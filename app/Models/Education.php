<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'country',
        'subjects',
        'addmission_year',
        'grad_year',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
