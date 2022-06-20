<?php

namespace App\Http\Controllers;

use App\Models\Chart;
use App\Models\Group;
use App\Models\Report;
use App\Models\Company;
use App\Models\Formula;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    
    
    protected $series = [
        'jan' => ['Jan', 'month',1, 'January'],
        'feb' => ['Feb', 'month',2, 'February'],
        'mar' => ['Mar', 'month',3, 'March'],
        'qr1' => ['Q1', 'quarter',1, 'FirstQuarter'],
        'apr' => ['Apr', 'month',4, 'April'],
        'may' => ['May', 'month',5, 'May'],
        'jun' => ['Jun', 'month',6, 'June'],
        'qr2' => ['Q2', 'quarter',2, 'SecondQuarter'],
        'jul' => ['Jul', 'month',7, 'July'],
        'aug' => ['Aug', 'month',8, 'August'],
        'sep' => ['Sep', 'month',9, 'September'],
        'qr3' => ['Q3', 'quarter',3, 'ThirdQuarter'],
        'oct' => ['Oct', 'month',10, 'October'],
        'nov' => ['Nov', 'month',11, 'November'],
        'dec' => ['Dec', 'month',12, 'December'],
        'qr4' => ['Q4', 'quarter',4, 'FourthQuarter'],
        'yar' => ['Year', 'yar', null, 'Year'],
    ];
    protected $months = [
        'jan' => ['Jan', 'month',1, 'January'],
        'feb' => ['Feb', 'month',2, 'February'],
        'mar' => ['Mar', 'month',3, 'March'],
        'apr' => ['Apr', 'month',4, 'April'],
        'may' => ['May', 'month',5, 'May'],
        'jun' => ['Jun', 'month',6, 'June'],
        'jul' => ['Jul', 'month',7, 'July'],
        'aug' => ['Aug', 'month',8, 'August'],
        'sep' => ['Sep', 'month',9, 'September'],
        'oct' => ['Oct', 'month',10, 'October'],
        'nov' => ['Nov', 'month',11, 'November'],
        'dec' => ['Dec', 'month',12, 'December'],
    ];
    
    protected $select = [
        // Chart
        'charts.id as chart_id',
        'charts.company_id',
        // Report
        'reports.id as report_id',
        'reports.year as year',
        'reports.section as section',
        'reports.format as format',
        'reports.name as name',
        'reports.jan as jan',
        'reports.feb as feb',
        'reports.mar as mar',
        'reports.qr1 as qr1',
        'reports.apr as apr',
        'reports.may as may',
        'reports.jun as jun',
        'reports.qr2 as qr2',
        'reports.jul as jul',
        'reports.aug as aug',
        'reports.sep as sep',
        'reports.qr3 as qr3',
        'reports.oct as oct',
        'reports.nov as nov',
        'reports.dec as dec',
        'reports.qr4 as qr4',
        'reports.yar as yar',
    ];
    
    public function fields(Company $company)
    {   
        $charts = [];
        $r = Report::query();
        $r->where('company_id', $company->id);
        $r->where('type', 'ratio');
        $r->orderBy('name');
        $rdata = $r->get();

        foreach ($rdata as $k => $rd) {
            $charts[] = [
                'company_id' => $company->id,
                'report_id' => $rd->id,
            ];
        }

        // return $charts;

        $unique = [
            'company_id',
            'report_id',
        ];

        $update = [];

        $chunks = collect($charts)->chunk(10);
        $inserts = [];
        // Using chunks insert the data
        foreach ($chunks as $chunk) {
            $inserts[] = Chart::upsert($chunk->toArray(), $unique, $update);
        }

        return new JsonResponse(['message' => 'Success', 'count' => array_sum($inserts)], 200);

    }
    
    
    public function index(Company $company, $year)
    {
        $last_year = (int)$year - 1;

        $ch = Chart::query();
        $ch->where('charts.company_id', $company->id);
        $ch->orWhere(function($query) use ($year, $last_year, $company) {
            $query
            ->where('charts.company_id', $company->id)
            ->where('reports.year', $year);
        });
        $ch->orWhere(function($query) use ($year, $last_year, $company) {
            $query
            ->where('charts.company_id', $company->id)
            ->where('reports.year', $last_year);
        });
        $ch->select($this->select);
        $ch->join('reports', 'charts.report_id', '=', 'reports.id');
        $charts = $ch->get();

        // return $charts;


        $ret = [];

        foreach ($charts as $key => $chart) {

            $k = Str::slug(Str::replace(' (%)', ' percent', Str::of($chart->name)->lower()));
            $k = Str::replace('-','_',$k);

            $data_name = 'und';

            if($chart->year == $year && $chart->section == 'actual'){ $data_name = 'Actual'; }
            if($chart->year == $year && $chart->section == 'forecast'){ $data_name = 'Forecast'; }
            if($chart->year == $last_year && $chart->section == 'actual'){ $data_name = 'Last Year'; }

            if($data_name != 'und'){
                $ret[$k]['identifier'] = $k;
                $ret[$k]['name'] = $chart->name;
                $ret[$k]['label'] = $chart->name;
                $ret[$k]['format'] = $chart->format;
                $ret[$k]['year'] = $year;
                $ret[$k]['series'][$key]['name'] = $data_name;
                foreach ($this->series as $sk => $sv) {
                    $ret[$k]['series'][$key]['data'][$sk] = (float)$chart[$sk];
                }
                $ret[$k]['series'] = array_values($ret[$k]['series']);
            }
        }

        return array_values($ret);
    }

    public function sparklines(Company $company, $year)
    {
        $r = Report::query();
        $r->where('company_id', $company->id);
        $r->where('section', 'actual');
        $r->where('year', $year);
        $r->where('depth', 0);
        $rdata = $r->get();

        // return $rdata;

        $ret = [];

        foreach ($rdata as $key => $report) {
            $k = Str::slug(Str::replace(' (%)', ' percent', Str::of($report->name)->lower()));
            $k = Str::replace('-','_',$k);
            
            $ret[$k]['identifier'] = $k;
            $ret[$k]['name'] = $report->name;
            $ret[$k]['label'] = $report->name;
            $ret[$k]['format'] = $report->format;
            $ret[$k]['year'] = $report->year;
            $ret[$k]['series']['name'] = $report->name;
            $kseries = 0;
            foreach ($this->months as $sk => $sv) {
                $ret[$k]['series']['data'][$sk] = (float)$report[$sk];
                $ret[$k]['categories'][] = $sv[0];
                $ret[$k]['current_amount'] = (float)$report[$sk];
                $kseries++;
            }
            
        }

        $ret = array_values($ret);

        $result = [];

        foreach ($ret as $rk => $rv) {
            $result[$rk] = $rv;
            $result[$rk]['series']['data'] = array_values($rv['series']['data']);
            $result[$rk]['series'] = [$result[$rk]['series']];
        }

        return $result;
    }
}
