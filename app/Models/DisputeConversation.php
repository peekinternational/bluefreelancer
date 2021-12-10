<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisputeConversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'dispute_id',
        'user_id',
        'message',
        'file',
    ];
}
