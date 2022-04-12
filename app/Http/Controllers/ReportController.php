<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Company;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function report(Request $request, Company $company, $type, $year, $depth)
    {
        return Report::query()
                ->where('company_id', $company->id)
                ->where('type', $type)
                ->where('year', $year)
                ->where('depth', $depth)
                ->get();
    }
}
