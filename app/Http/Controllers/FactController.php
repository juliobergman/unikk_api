<?php

namespace App\Http\Controllers;

use App\Models\Fact;
use App\Models\Company;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\DateDimension;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class FactController extends Controller
{
    
    public function index(Company $company)
    {
        return Fact::where('company_id', $company->id)->orderBy('category_id')->get();
    }
    
    public function show(Fact $fact)
    {
        $fact = Fact::query()
                ->where('id', $fact->id)
                ->with('fulldate')
                ;

        return $fact->first();
    }

    public function set(Request $request, Company $company)
    {
        $dates = DateDimension::all();
        $categories = Category::where('company_id', $company->id)->isLeaf()->get();
        $set = [];

        foreach ($dates as $kd => $date) {
            foreach ($categories as $kc => $category) {
                $set[] = [
                    'section' => 'forecast',
                    'date' => $date->date,
                    'category_id' => $category->id,
                    'company_id' => $company->id,
                    'amount' => 0,
                ];
                $set[] = [
                    'section' => 'actual',
                    'date' => $date->date,
                    'category_id' => $category->id,
                    'company_id' => $company->id,
                    'amount' => 0,
                ];

                // return $set;

            }
        }

        $chunks = collect($set)->chunk(50);

        // Using chunks insert the data
        foreach ($chunks as $chunk) {
            Fact::insertOrIgnore($chunk->toArray());
        }

        // Response
        return new JsonResponse(['message' => 'Success', 'count' => collect($set)->count()], 200);
        return count($set);
    }

    public function edit(Request $request, Company $company, $type, $year, $section)
    {
        
        if($type == 'ratio'){
            return new JsonResponse(['message' => 'No Data'], 200);
        }
        
        $select = [
            '*',
            DB::raw('month(date) as month')
        ];
        
        $categories = Category::query();
        $categories->where('company_id', $company->id);
        $categories->where('type', $type);
        $categories->tree();
        $categories->where('depth', 2);

        // $categories->select($select);
        
        // $categories->withCount(['factLeaf' => function($query) use ($company, $type, $year, $section){
        //     $query->where('company_id', $company->id);
        //     $query->whereYear('date', $year);
        //     $query->where('section', $section);
        // }]);
        $categories->with(['facts' => function($query) use ($company, $type, $year, $section, $select){
            $query->where('company_id', $company->id);
            $query->whereYear('date', $year);
            $query->where('section', $section);
            $query->select($select);
        }]);
        
        
        $categories->orderBy('sort', 'asc');
        $categories->orderBy('account', 'asc');
        // $categories->take(10);
        // return $categories->get()->pluck('id');
        $data = $categories->get();

        foreach ($data as $key => $category) {
            $ret[$key] = $category;
            // $ret[$key]['facts'] = $category->facts->groupBy('month');
            $gdata = $category->facts->groupBy('month');
            foreach ($gdata as $k => $gd) {
                $ret[$key]['facts'][$k] = $gd->sum('amount');
            }
        }

        $ret = collect($ret);

        return $ret;

    }

    public function store(Request $request)
    {
        $request->validate([
            // 'company_id' => ['exists:companies'],
            'type' => ['required'],
            'year' => ['required'],
            'section' => ['required'],
        ]);

        $company = $request->company_id;
        $type = $request->type;
        $year = $request->year;
        $section = $request->section;
        $data = $request->data;
        $upsert = array();

        $unique = [
            'section',
            'date',
            'category_id',
            'company_id',
        ];

        foreach ($data as $category) {
            $facts = $category['facts'];
            foreach ($facts as $month => $amount) {
                if(!is_array($amount)){
                    if($amount === null){
                        $amount = 0;
                    }
                    $date = new DateTime($year.'-'.$month.'-01');
                    $upsert[] = [
                        'section' => $section,
                        'date' => $date->format('Y-m-d'),
                        'category_id' => $category['id'],
                        'company_id' => $company,
                        'amount' => $amount,
                    ];
                }

            }
            // return $facts;
        }


        $success = Fact::upsert($upsert, $unique, ['amount']);

        return $success;
        
    }
}