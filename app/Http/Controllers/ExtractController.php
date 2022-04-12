<?php

namespace App\Http\Controllers;

use App\Models\Fact;
use App\Models\Company;
use App\Models\Category;
use Illuminate\Http\Request;

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
    
    protected function getRow(Company $company, $year, $data, $depth = 0, $section, $class = '', $row = 0){

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

        return [
            'row' => $row,
            'company_id' => $company->id,
            'category_id' => '',
            'type' => $data->type,
            'year' => $year,
            'depth' => $depth,
            'section' => $section,
            'name' => $data->name,
            'account' => $data->account,
            'result_field' => '',
            'format' => $data->format,
            'branch' => $data->branch,
            'row_class' => $cssClass,
            'jan' => $data->jan,
            'feb' => $data->feb,
            'mar' => $data->mar,
            'qr1' => $data->qr1,
            'apr' => $data->apr,
            'may' => $data->may,
            'jun' => $data->jun,
            'qr2' => $data->qr2,
            'jul' => $data->jul,
            'aug' => $data->aug,
            'sep' => $data->sep,
            'qr3' => $data->qr3,
            'oct' => $data->oct,
            'nov' => $data->nov,
            'dec' => $data->dec,
            'qr4' => $data->qr4,
            'yar' => $data->yar,
            'is_hidden' => $data->yar ? false : true,
        ];
    }
    
    protected function tree(Company $company, $year, $type, $section)
    {
        $group = Category::query();
        $group->where('company_id', $company->id);
        $group->where('type', $type);
        $group->isRoot();
        $group->depthFirst();
        $group->tree();
        // $group->with('rootAncestor');
        $group->with(['facts' => function($query) use ($section, $company, $year, $type){
            $query->where('company_id', $company->id);
            $query->whereYear('facts.date', $year);
            $query->where('section', $section);
        }]);
        $group->with(['facts' => function($query) use ($section, $company, $year, $type){
            $query->where('company_id', $company->id);
            $query->whereYear('facts.date', $year);
            $query->where('section', $section);
        }]);
        // $group->with(['factsOffspring' => function($query) use ($af, $company, $year, $type){
        //     $query->where('company_id', $company->id);
        //     $query->whereYear('facts.date', $year);
        //     $query->where('type', $af);
        // }]);
        $group->with(['children' => function($q1) use ($company, $year, $section){
            // $q1->with('rootAncestor');
            $q1->with(['facts' => function($q2) use ($company, $year, $section){
                $q2->where('company_id', $company->id);
                $q2->whereYear('facts.date', $year);
                $q2->where('section', $section);
            }]);
            
            $q1->with(['children' => function($q2) use ($company, $year, $section){
                // $q2->with('rootAncestor');
                $q2->with(['facts' => function($q3) use ($company, $year, $section){
                    $q3->where('company_id', $company->id);
                    $q3->whereYear('facts.date', $year);
                    $q3->where('section', $section);
                }]);

                $q2->with(['children' => function($q3) use ($company, $year, $section){
                    // $q3->with('rootAncestor');
                    $q3->with(['facts' => function($q4) use ($company, $year, $section){
                        $q4->where('company_id', $company->id);
                        $q4->whereYear('facts.date', $year);
                        $q4->where('section', $section);
                    }]);
                }]);
            }]);

        }]);
        // $group->with(['descendants' => function($query) use ($company, $year, $section){
        //     $query->with(['facts' => function($qry) use ($company, $year, $section){
        //         $qry->where('company_id', $company->id);
        //         $qry->whereYear('facts.date', $year);
        //         $qry->where('section', $section);
        //     }]);
        // }]);
        // $group->with(['facts' => function($qry) use ($company, $year, $section){
        //     $qry->where('company_id', $company->id);
        //     $qry->whereYear('facts.date', $year);
        //     $qry->where('section', $section);
        // }]);
        $group->orderBy('sort');
        return $group->get();
    }
}
