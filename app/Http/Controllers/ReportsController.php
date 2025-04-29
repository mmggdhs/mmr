<?php

namespace App\Http\Controllers;

use App\Models\Reports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller{
    public function addreport(Request $request){
        $request->validate([
            'project_id'=>"required",
            'details'=>"required"
        ]);
        Reports::create([
            'user_id'=>Auth::user()->id,
            'project_id'=>$request->input('project_id'),
            'details'=>$request->input('details')
        ]);
        return back();
    }
    public function getreports(string $id)
{
    
    $reports = Reports::where('project_id', $id)->get();

    
    return view('pages.myprojects', compact('reports'));
}
}

