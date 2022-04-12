<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ExtractIncomeController extends ExtractController
{
    public function index(Request $request, Company $company, $year)
    {
        $section = $request->forecast ? 'forecast' : 'actual';
        $data = $this->tree($company, $year, 'income', $section);

        // return $data;

        foreach ($data as $k1 => $lvl1) {
            $upsert[] = $this->getRow($company, $year, $lvl1, 0, $section, '', ($k1 + 1));
            foreach ($lvl1->children as $k2 => $lvl2) {
                $upsert[] = $this->getRow($company, $year, $lvl2, 1, $section, '', ($k2 + 1));
                foreach ($lvl2->children as $k3 => $lvl3) {
                    $upsert[] = $this->getRow($company, $year, $lvl3, 2, $section, '', ($k3 + 1));
                    foreach ($lvl3->children as $k4 => $lvl4) {
                        $upsert[] = $this->getRow($company, $year, $lvl4, 3, $section, '', ($k4 + 1));
                    }
                }
            }
            
        }

        // return $upsert;

        // Columns to Update
        $colUpdate = [
            'row',
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
        ];

        $compare = [
            'year',
            'company_id',
            'lvl',
            'report_id',
        ];
        
        $ret = DB::table('reports')->upsert($upsert, $compare, $colUpdate);
        // Response
        return new JsonResponse(['message' => 'Success', 'rows' => $ret], 200);
    }
}