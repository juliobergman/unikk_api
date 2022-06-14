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
        
        $report->where('company_id', $company->id);
        $report->where('level', $level);
        $report->where('type', $type);
        $report->where('year', $year);
        $report->where('section', $section);
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

        $report->orderBy('row');

        $rows = $report->get();

        if($type == 'income'){
            $ebit = Report::query();
            $ebit->where('company_id', $company->id);
            $ebit->where('level', $level);
            $ebit->where('type','ebit');
            $ebit->where('year', $year);
            $ebit->where('section', $section);
            $ebit->orderBy('row');

            $ebits = $ebit->get();
            $rows = $rows->merge($ebits);
        }




        return $rows;
    }
}
