<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'trans_id',
        'user_id',
        'token',
        'gross_amt',
        'fee_amt',
        'net_amt',
        'payer_id',
        'email',
        'currency_code',
        'country_code',
        'status',
        // 'trans_time',
    ];
}
