<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisputeArbitration extends Model
{
    use HasFactory;
    protected $fillable = [
        'dispute_id',
        'user_id',
        'status',
    ];

    public static function count($id)
    {
        $disputeArbi = DisputeArbitration::where('dispute_id', $id)->count();
        if ($disputeArbi == 2) {
            return true;
        } else {
            return false;
        }
    }
}
