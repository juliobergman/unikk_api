<?php

namespace App\Http\Controllers;

use App\Models\Fact;
use App\Models\Group;
use App\Models\Report;
use App\Models\Company;
use Nette\Utils\Arrays;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Sequence;
use App\Http\Controllers\FactController;

class ExtractIncomeController extends ExtractController
{
    public function index(Company $company, $type, $year, $section)
    {        
        $groups = Group::where('type', $type)->get();
        $depths = [0,1,2];
        $data = array();
        foreach ($depths as $dkey => $depth) {
            $row = 1;
            $total_f = [];
            $total_d = [];
            foreach ($groups as $group) {
                $facts = $this->getCategories($company, $type, $year, $section, $group, $depth);
                $facts_count = count($facts);
                foreach ($facts as $k => $fact) {
                    // return  $this->getRow($fact, $company, $type, $year, $section, $depth, $row);
                    $data[] = $this->getRow($fact, $company, $type, $year, $section, $depth, $row);
                    $total_f = array_merge($total_f, $fact['facts']);
                    $total_d = array_merge($total_d, $fact['descendants']);
                    $row++;
                    // Total Row
                    if($facts_count === ($k + 1)){
                        $fdata = $fact;
                        $fdata['id'] = null;
                        $fdata['name'] = $fact['group_name'];
                        $fdata['facts'] = $total_f;
                        $fdata['descendants'] = $total_d;                  
                        $data[] = $this->getRow($fdata, $company, $type, $year, $section, $depth, $row, true, 'header-row');
                        $row++;
                    }
                    
                }
            }
        }

        // return $data;
        // return count($data);
        
        $unique = [
            'company_id',
            'type',
            'depth',
            'section',
            'year'
        ];
        $update = [
            'category_id',
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
            'is_hidden',
            'required',
        ];

        $chunks = collect($data)->chunk(10);

        // Using chunks insert the data
        foreach ($chunks as $chunk) {
            $inserts[] = Report::upsert($chunk->toArray(), $unique, $update);
        }

        (new FormulaLanding)->ebit($company, $year, $section);
        (new FormulaLanding)->ratio($company, $year, $section);

        return new JsonResponse(['message' => 'Success', 'count' => array_sum($inserts)], 200);
    }
}