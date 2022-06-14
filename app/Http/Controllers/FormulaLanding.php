<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Report;
use App\Models\Company;
use App\Models\Formula;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FormulaLanding extends FormulaExtract
{
    public function get(Company $company)
    {
        $f = Formula::where('company_id', $company->id)->get();
        $formulas = array();
        foreach ($f as $formula) {
            $formulas[$formula->identifier] = $formula;
        }

        $groups = Group::all();

        foreach ($groups as $value) {
            $identifier = Str::snake($value->name);
            $formulas[$identifier] = [
                "company_id" => $company->id,
                "type" => $value->type,
                "group_id" => $value->id,
                "category_id" => null,
                "identifier" => $identifier,
                "table" => 'group',
                "category_name" => $value->name,
                "group_name" => null,
            ];
        }

        return $formulas;
    }
    
    public function store(Request $request)
    {
        $data = collect($request->all())->except(['company_id']);;
        $formula_data = array();

        // return $data;

        foreach ($data as $key => $value) {

            $formula_data[$key] = [
                'company_id' => $value['company_id'],
                'type' => $value['type'],
                'group_id' => $value['group_id'],
                'category_id' => $value['id'],
                'identifier' => $key,
                'category_name' => $value['name'],
                'group_name' => $value['group_name'],
            ];
        }

        $unique = [
            'company_id',
            'identifier'
        ];

        $update_fields = [
            // 'company_id',
            // 'type',
            'group_id',
            'category_id',
            // 'identifier',
            'category_name',
            'group_name',
        ];

        $success = Formula::upsert($formula_data, $unique, $update_fields);
        return $success;

        return $formula_data;
    }

    public function insert($rows)
    {
        $unique = [
            'company_id',
            'type',
            'depth',
            'section',
            'year',
        ];

        $update = array_keys($this->slots);
        array_push($update, 'is_hidden','required','row_class','name');

        // return $update;

        $chunks = collect($rows)->chunk(10);

        // Using chunks insert the data
        foreach ($chunks as $chunk) {
            $inserts[] = Report::upsert($chunk->toArray(), $unique, $update);
        }

        return new JsonResponse(['message' => 'Success', 'count' => array_sum($inserts)], 200);
    }


    // Identifiers
    public function ebit(Company $company, $year, $section)
    {
        $formulas = $this->get($company);
        $data = $this->data($company, $year, $section, $formulas);
        $depths = [0,1,2];
        $row = 0;
        $rows = [];

        foreach ($depths as $depth) {

        // EBIT
            if (
            isset($data['net_income']) &&
            isset($data['ebit_financial_cost']) &&
            isset($data['ebit_taxes'])
        ) {
                $rows[$row] = $this->ebit_row(
                    $data['net_income'],
                    $data['ebit_financial_cost'],
                    $data['ebit_taxes'],
                    1,
                    $company,
                    $section,
                    $year,
                    $depth
                );
                $row++;
            }
        
            // EBITDA
            if (
            isset($data['net_income']) &&
            isset($data['ebit_financial_cost']) &&
            isset($data['ebit_taxes']) &&
            isset($data['ebit_da'])
        ) {
                $rows[$row] = $this->ebitda_row(
                    $data['net_income'],
                    $data['ebit_financial_cost'],
                    $data['ebit_taxes'],
                    $data['ebit_da'],
                    2,
                    $company,
                    $section,
                    $year,
                    $depth
                );
                $row++;
            }
        }

        // return $data;

        // return $rows;
        return $this->insert($rows);
    }

    public function ratio(Company $company, $year, $section)
    {
        $formulas = $this->get($company);
        $data = $this->data($company, $year, $section, $formulas);

        $rows = [];

        // Income
        if(isset($data['income'])){
            $rows[0] = $data['income'];
            $rows[0]['row'] = 1;
            $rows[0]['type'] = 'ratio';
        }

        // Gross Profit
        if (isset($data['gross_profit'])) {
            $rows[1] = $data['gross_profit'];
            $rows[1]['row'] = 2;
            $rows[1]['type'] = 'ratio';
        }

        // Gross Profit Percentage
        if(isset($data['gross_profit']) && isset($data['income'])){
            $rows[2] = $this->gross_profit_percentage_row($data['gross_profit'], $data['income'], 3, $company, $section, $year);
        }

        // Net Income
        if (isset($data['net_income'])) {
            $rows[3] = $data['net_income'];
            $rows[3]['row'] = 4;
            $rows[3]['type'] = 'ratio';
        }

        // Net Income Percentage
        if(isset($data['net_income']) && isset($data['income'])){
            $rows[4] = $this->net_income_percentage_row($data['net_income'], $data['income'], 5, $company, $section, $year);
        }
        
        // Ebitda
        if(
            isset($data['net_income']) &&
            isset($data['ebit_financial_cost']) &&
            isset($data['ebit_taxes']) &&
            isset($data['ebit_da'])
        ){
            $rows[5] = $this->ebitda_row(
                $data['net_income'],
                $data['ebit_financial_cost'],
                $data['ebit_taxes'],
                $data['ebit_da'],
                6,
                $company,
                $section,
                $year,
                0
            );
        }
        // Ebitda (%)
        if(
            isset($data['net_income']) &&
            isset($data['ebit_financial_cost']) &&
            isset($data['ebit_taxes']) &&
            isset($data['ebit_da']) &&
            isset($data['income'])
        ){
            $rows[6] = $this->ebitda_percentage_row(
                $data['net_income'],
                $data['ebit_financial_cost'],
                $data['ebit_taxes'],
                $data['ebit_da'],
                $data['income'],
                7,
                $company,
                $section,
                $year
            );
        }

        // Current Ratio
        if(isset($data['total_current_assets']) && isset($data['short_term_liabilities'])){
            $rows[7] = $this->current_ratio_row($data['total_current_assets'],$data['short_term_liabilities'],8,$company,$section,$year);
        }
        // Working Capital
        if(isset($data['total_current_assets']) && isset($data['short_term_liabilities'])){
            $rows[8] = $this->working_capital_row($data['total_current_assets'],$data['short_term_liabilities'],9,$company,$section,$year);
        }
        // Cash Ratio
        if(
        isset($data['cash_and_cash_equivalents']) &&
        isset($data['short_term_assets_listed_stock_exchange']) &&
        isset($data['short_term_liabilities'])
        ){
            $rows[9] = $this->cash_ratio_row($data['cash_and_cash_equivalents'],$data['short_term_assets_listed_stock_exchange'],$data['short_term_liabilities'],10,$company,$section,$year);
        }
            
        // Return on equity
        if(isset($data['net_income']) && isset($data['total_equity'])){
            $rows[10] = $this->return_on_equity_row($data['net_income'],$data['total_equity'],11,$company,$section,$year);
        }
        // Debt to equity
        if(isset($data['total_liabilities']) && isset($data['total_equity'])){
            $rows[11] = $this->debt_to_equity_row($data['total_liabilities'],$data['total_equity'],12,$company,$section,$year);
        }
        // Interest Coverage
        if(
            isset($data['net_income']) &&
            isset($data['ebit_financial_cost']) &&
            isset($data['ebit_taxes']) &&
            isset($data['interest_expenses'])
        )
        {
            $rows[12] = $this->interest_coverage_row($data['net_income'],$data['ebit_financial_cost'],$data['ebit_taxes'],$data['interest_expenses'],13,$company,$section,$year);
        }
       
        // NOPAT
        if(isset($data['operative_income']) && isset($data['effective_tax_rate'])){
            $rows[13] = $this->nopat_row($data['operative_income'],$data['effective_tax_rate'],14,$company,$section,$year);
        }

        // ROIC
        if(
            isset($data['operative_income']) &&
            isset($data['effective_tax_rate']) &&
            isset($data['total_liabilities']) &&
            isset($data['total_equity']) &&
            isset($data['cash_and_cash_equivalents'])
        ){
            $rows[14] = $this->roic_row(
                $data['operative_income'],
                $data['effective_tax_rate'],
                $data['total_liabilities'],
                $data['total_equity'],
                $data['cash_and_cash_equivalents'],
                15,$company,$section,$year);
        }

        // Adjusted Equity
        if(isset($data['total_equity']) && isset($data['net_income'])){
            $rows[15] = $this->adjusted_equity_row($data['total_equity'],$data['net_income'],16,$company,$section,$year);
        }

        // Book Value Per Share
        if(
        isset($data['total_equity']) &&
        isset($data['net_income']) &&
        isset($data['number_of_shares'])
        ){
            $rows[16] = $this->book_value_per_share_row($data['total_equity'],$data['net_income'],$data['number_of_shares'],17,$company,$section,$year);
        }
    
        foreach ($rows as $rk => $row) {
           $rows[$rk]['row_class'] = 'data-row text-bolder';
           $rows[$rk]['type'] = 'ratio';
        }

        // return $data['adjusted_equity'];
        // return $data;
        // return $rows[16];
        // return $rows;
        return $this->insert($rows);
    }


}