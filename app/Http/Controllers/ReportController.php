<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Company;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function report(Request $request, Company $company, $type, $year, $section, $level)
    {
        $hidden = $request->hidden ? true : false;
        $report = Report::query();

        
        $report
        ->where('company_id', $company->id)
        ->where('level', $level)
        ->where('type', $type)
        ->where('year', $year)
        ->where('section', $section);
        ;
        // if(!$hidden){
        //     $report->where('is_hidden', false);
        // }
        
        // $report
        //     ->orWhere(function($query) use ($company, $type, $year, $level, $section, $hidden) {
        //     $query
        //         ->where('company_id', $company->id)
        //         ->where('type', $type)
        //         ->where('year', $year)
        //         ->where('section', $section)
        //         ->where('required', true);
        //     if(!$hidden){
        //         $query->where('is_hidden', false);
        //     }
        // });

        $report
            ->orderBy('row');

        return $report->get();
    }
}
