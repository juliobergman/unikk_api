<?php

namespace App\Http\Controllers;

use App\Models\Fact;
use App\Models\Company;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ExtractController extends Controller
{
    
    
    protected $date_fields = [
        'jan' => ['month',1],
        'feb' => ['month',2],
        'mar' => ['month',3],
        'qr1' => ['quarter',1],
        'apr' => ['month',4],
        'may' => ['month',5],
        'jun' => ['month',6],
        'qr2' => ['quarter',2],
        'jul' => ['month',7],
        'aug' => ['month',8],
        'sep' => ['month',9],
        'qr3' => ['quarter',3],
        'oct' => ['month',10],
        'nov' => ['month',11],
        'dec' => ['month',12],
        'qr4' => ['quarter',4],
        'year' => ['year', null],
    ];
    
    public $select_facts = [
        'facts.id',
        'facts.section',
        'facts.date',
        'facts.category_id',
        'facts.company_id',
        'facts.amount',
        // Date
        'date_dimensions.date',
        // 'date_dimensions.day',
        'date_dimensions.month',
        'date_dimensions.year',
        // 'date_dimensions.day_name',
        // 'date_dimensions.day_suffix',
        // 'date_dimensions.day_of_week',
        // 'date_dimensions.day_of_year',
        // 'date_dimensions.is_weekend',
        // 'date_dimensions.week',
        // 'date_dimensions.iso_week',
        // 'date_dimensions.week_of_month',
        // 'date_dimensions.week_of_year',
        // 'date_dimensions.iso_week_in_year',
        // 'date_dimensions.month_name',
        'date_dimensions.month_name_short',
        // 'date_dimensions.month_year',
        // 'date_dimensions.month_name_year',
        // 'date_dimensions.first_day_of_month',
        // 'date_dimensions.last_day_of_month',
        // 'date_dimensions.first_day_of_next_month',
        'date_dimensions.quarter',
        'date_dimensions.quarter_name',
        // 'date_dimensions.first_day_of_quarter',
        // 'date_dimensions.last_day_of_quarter',
        // 'date_dimensions.first_day_of_year',
        // 'date_dimensions.last_day_of_year',
        // 'date_dimensions.first_day_of_next_year',
        // 'date_dimensions.dow_in_month',
    ];

    protected function getCategories($company, $type, $year, $section, $group, $depth = 0)
    {   
        $schema = Category::query();
        $schema->where('company_id', $company->id);
        $schema->where('type', $type);
        $schema->where('group_id', $group->id);
        $schema->where('depth', $depth);
        $schema->tree();
        $schema->with(['facts' => function($q2) use ($section, $company, $year){
            $q2->where('facts.company_id', $company->id);
            $q2->whereYear('facts.date', $year);
            $q2->where('facts.section', $section);
        }]);
        $schema->with(['descendants' => function($query) use ($section, $company, $year){
            $query->with(['facts' => function($q2) use ($section, $company, $year){
                $q2->where('facts.company_id', $company->id);
                $q2->whereYear('facts.date', $year);
                $q2->where('facts.section', $section);
            }]);
            // $query->where('facts.company_id', $company->id);
            // $query->whereYear('facts.date', $year);
            // $query->where('facts.section', $section);
        }]);
        // $schema->with('adjFacts');
        $schema->orderBy('sort', 'asc');
        $data = $schema->get()->toArray();

        return $data;
        
        foreach ($data as $k1 => $v1) {
            // return $v1;
            $result[$k1]['group_id'] = $v1['group_id'];
            $result[$k1]['group_name'] = $v1['group_name'];
            $result[$k1]['id'] = $v1['id'];
            $result[$k1]['type'] = $v1['type'];
            $result[$k1]['depth'] = $v1['depth'];
            $result[$k1]['level'] = $v1['depth'] + 1;
            $result[$k1]['name'] = $v1['name'];
            $result[$k1]['account'] = $v1['account'];
            $result[$k1]['format'] = $v1['format'];
            $result[$k1]['facts'] = [];
            foreach ($v1['descendants'] as $k2 => $v2) {
                $facts[] = $v2['facts'];
            }
            foreach ($facts as $k3 => $v3) {
                if(isset($v3[0])){
                    $result[$k1]['facts'][] = $v3[0];
                }
            }
        }
        return $result;
    }

    protected function getRow($data, Company $company, $type, $year, $section, $depth, $row, $header = false, $class = '')
    {

        // return $data;
        // if($class == "header-row"){
        //     dd($data);
        // }
        
        if($class){
            $css = $class;
        }
        if(!$class){
            $css = 'data-row';
        }
        if($depth === 0){
            $css = $css.' text-bolder';
            // $depth = 1;
        }

        $cssClass = trim($css);
        $facts = collect([]);
        // return $data;
        if(isset($data['facts'])){
            if(count($data['facts'])){
                $facts = collect($data['facts']);
            }
            if(count($data['descendants'])){
                foreach ($data['descendants'] as $key => $descendant) {
                    if(count($descendant['facts'])){
                        $facts = $facts->merge($descendant['facts']);
                    }
                }
            }
            // return $facts;
        }
        return [
            'row' => $row,
            'company_id' => $company->id,
            'group_id' => $data['group_id'],
            'group_name' => $data['group_name'],
            'category_id' => $data['id'],
            'type' => $data['type'],
            'year' => $year,
            'depth' => $data['depth'],
            'level' => $data['depth'] + 1,
            'section' => $section,
            'name' => $header ? $data['group_name'] : $data['name'],
            'account' => $data['account'],
            // 'result_field' => '',
            'format' => $data['format'],
            // 'branch' => $data['branch'],
            'row_class' => $cssClass,
            'jan' => $facts->where('year', $year)->where('month', 1)->sum('amount'),
            'feb' => $facts->where('year', $year)->where('month', 2)->sum('amount'),
            'mar' => $facts->where('year', $year)->where('month', 3)->sum('amount'),
            'qr1' => $facts->where('year', $year)->where('quarter', 1)->sum('amount'),
            'apr' => $facts->where('year', $year)->where('month', 4)->sum('amount'),
            'may' => $facts->where('year', $year)->where('month', 5)->sum('amount'),
            'jun' => $facts->where('year', $year)->where('month', 6)->sum('amount'),
            'qr2' => $facts->where('year', $year)->where('quarter', 2)->sum('amount'),
            'jul' => $facts->where('year', $year)->where('month', 7)->sum('amount'),
            'aug' => $facts->where('year', $year)->where('month', 8)->sum('amount'),
            'sep' => $facts->where('year', $year)->where('month', 9)->sum('amount'),
            'qr3' => $facts->where('year', $year)->where('quarter', 3)->sum('amount'),
            'oct' => $facts->where('year', $year)->where('month', 10)->sum('amount'),
            'nov' => $facts->where('year', $year)->where('month', 11)->sum('amount'),
            'dec' => $facts->where('year', $year)->where('month', 12)->sum('amount'),
            'qr4' => $facts->where('year', $year)->where('quarter', 4)->sum('amount'),
            'yar' => $facts->where('year', $year)->sum('amount'),
            'is_hidden' => $facts->where('year', $year)->sum('amount') ? false : true,
            'required' => $header ? true : false
            // 'data' => $facts
        ];
    }
    
}