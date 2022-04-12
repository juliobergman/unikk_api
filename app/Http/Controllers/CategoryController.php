<?php

namespace App\Http\Controllers;

use App\Models\Fact;
use App\Models\Company;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request, Company $company)
    {
        
        $hidden = [
            'is_hidden',
            'facts',
            'jan',
            'feb',
            'mar',
            'qr1',
            'apr',
            'may',
            'jun',
            'qr2',
            'jul',
            'aug',
            'sep',
            'qr3',
            'oct',
            'nov',
            'dec',
            'qr4',
            'yar',
        ];

        $categories = Category::query();
        $categories->where('company_id', $company->id);
        $categories->tree();
        return $categories->get()->makeHidden($hidden);
    }
    public function accounts(Request $request, Company $company)
    {
        
        $hidden = [
            'is_hidden',
            'facts',
            'jan',
            'feb',
            'mar',
            'qr1',
            'apr',
            'may',
            'jun',
            'qr2',
            'jul',
            'aug',
            'sep',
            'qr3',
            'oct',
            'nov',
            'dec',
            'qr4',
            'yar',
        ];

        $categories = Category::query();
        $categories->where('company_id', $company->id);
        $categories->isLeaf();
        return $categories->get()->makeHidden($hidden);
    }

    public function report(Request $request, Company $company, $type, $year, $depth)
    { // /{company}/{type}/{year}/{depth}


        $af = $request->forecast ? 'forecast' : 'actual';
        $report = Category::query();
        $report->where('company_id', $company->id);
        $report->where('type', $type);
        $report->where('depth', $depth);
        $report->depthFirst();
        $report->tree();
        $report->with(['factsOffspring' => function($query) use ($af, $company, $year, $type){
            $query->where('company_id', $company->id);
            $query->whereYear('facts.date', $year);
            $query->where('section', $af);
        }]);
        $report->orderBy('sort');
        return $report->get()->makeHidden(['facts','facts_offspring']);;
    }
}
