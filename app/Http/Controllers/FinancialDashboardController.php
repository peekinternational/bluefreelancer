<?php

namespace App\Http\Controllers;

use App\Models\Escrow;
use Illuminate\Http\Request;

class FinancialDashboardController extends Controller
{
    public function employer()
    {
        $results = Escrow::where('from', auth()->id())->with('milestone')->simplePaginate(15);  
        return view('financial-dashboard.employer', [
            'results' => $results
        ]);
    }

    public function freelancer()
    {
        $results = Escrow::where('to', auth()->id())->with('milestone')->simplePaginate(15);  
        return view('financial-dashboard.freelancer', [
            'results' => $results
        ]);
    }
}
