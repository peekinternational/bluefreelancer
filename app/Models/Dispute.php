<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispute extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'to',
        'freelancer_id',
        'client_id',
        'project_id',
        'type',
        'req_evidence_detail',
        'req_solution_detail',
        'file',
        'offer_amt',
        'freelancer_offer_amt',
        'client_offer_amt',
        'milestone_id',
        'status',
    ];

    public static function clientDispute($project_id)
    {
        $user_id = Project::where('project_id', $project_id)->first()->user_id;
        if ($user_id == auth()->id()) {
            return true;
        } else {
            return false;
        }
    }

    public static function getClient($project_id)
    {
        return Project::where('project_id', $project_id)->first()->user_id;
    }

    public static function getFreelancer($ms_id)
    {
        $bid_id = Milestone::where('id', $ms_id)->first()->bid_id;
        return Bid::where('id', $bid_id)->first()->user_id;
    }

}
