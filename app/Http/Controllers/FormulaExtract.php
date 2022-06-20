<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Company;
use App\Models\CompanyData;
use Illuminate\Http\Request;

class FormulaExtract extends FormulaController
{
    
    public function data(Company $company, $year, $section, $formulas)
    {
        $data = [];
        foreach ($formulas as $key => $value) {
            if($value['table'] == 'category'){    
                $data[$value['identifier']] = Report::where('company_id', $company->id)->where('year', $year)->where('section', $section)->where('category_id', $value['category_id'])->first();
            }
            if($value['table'] == 'group'){  
                $data[$value['identifier']] = Report::where('company_id', $company->id)->where('year', $year)->where('section', $section)->where('group_id', $value['group_id'])->where('category_id', null)->first();
            }
        }

        $companyData = CompanyData::where('company_id', $company->id)->first();
        $data['effective_tax_rate'] = (float)$companyData->taxrate;
        $data['number_of_shares'] = (float)$companyData->shares;

        foreach ($data as $dk => $dv) {
            if(isset($data[$dk]['id'])){
                unset($data[$dk]['id']);
            }
        }
        return $data;
    }

    protected function ebit_row($net, $fcost, $taxes, $num, $company, $section, $year, $depth)
    {
        
        $result = [
            'row' => $num,
            'company_id' => $company->id,
            'group_id' => null,
            'category_id' => null,
            'type' => 'ebit',
            'year' => $year,
            'depth' => $depth,
            'level' => $depth + 1,
            'section' => $section,
            'name' => 'EBIT',
            'account' => null,
            'group_name' => null,
            'format' => 'currency',
            'row_class' => 'data-row',
            'is_hidden' => false,
            'required' => true,
        ];

        foreach ($this->slots as $slot => $val) {
            $result[$slot] = $this->ebit_formula($net[$slot],$fcost[$slot],$taxes[$slot]);
        }
        
        return $result;
    }
    protected function ebitda_row($net, $fcost, $taxes, $da, $num, $company, $section, $year, $depth = 0, $type = 'ebit')
    {
        
        $result = [
            'row' => $num,
            'company_id' => $company->id,
            'group_id' => null,
            'category_id' => null,
            'type' => $type,
            'year' => $year,
            'depth' => $depth,
            'level' => $depth + 1,
            'section' => $section,
            'name' => 'EBITDA',
            'account' => null,
            'group_name' => null,
            'format' => 'currency',
            'row_class' => 'header-row',
            'is_hidden' => false,
            'required' => true,
        ];

        foreach ($this->slots as $slot => $val) {
            $result[$slot] = $this->ebitda_formula($net[$slot],$fcost[$slot],$taxes[$slot], $da[$slot]);
        }
        
        return $result;
    }

    protected function ebitda_percentage_row($net, $fcost, $taxes, $da, $income, $row, $company, $section, $year, $depth = 0)
    {
        
        $result = [
            'row' => $row,
            'company_id' => $company->id,
            'group_id' => null,
            'category_id' => null,
            'type' => 'ratio',
            'year' => $year,
            'depth' => $depth,
            'level' => $depth + 1,
            'section' => $section,
            'name' => 'EBITDA (%)',
            'account' => null,
            'group_name' => null,
            'format' => 'percentage',
            'row_class' => 'data-row',
            'is_hidden' => false,
            'required' => true,
        ];

        foreach ($this->slots as $slot => $val) {
            $result[$slot] = $this->ebitda_percentage_formula($net[$slot],$fcost[$slot],$taxes[$slot],$da[$slot],$income[$slot]);
        }
        
        return $result;
    }

    protected function gross_profit_percentage_row($gross_profit, $income, $row, $company, $section, $year, $depth = 0)
    {
        $result = [
            'row' => $row,
            'company_id' => $company->id,
            'group_id' => null,
            'category_id' => null,
            'type' => 'ratio',
            'year' => $year,
            'depth' => $depth,
            'level' => $depth + 1,
            'section' => $section,
            'name' => 'Gross Profit (%)',
            'account' => null,
            'group_name' => null,
            'format' => 'percentage',
            'row_class' => 'data-row',
            'is_hidden' => false,
            'required' => true,
        ];

        foreach ($this->slots as $slot => $val) {
            $result[$slot] = $this->gross_profit_percentage_formula($gross_profit[$slot], $income[$slot]);
        }
        
        return $result;
    }

    protected function net_income_percentage_row($net_income, $income, $num, $company, $section, $year, $depth = 0)
    {
        
        $result = [
            'row' => $num,
            'company_id' => $company->id,
            'group_id' => null,
            'category_id' => null,
            'type' => 'ratio',
            'year' => $year,
            'depth' => $depth,
            'level' => $depth + 1,
            'section' => $section,
            'name' => 'Net Income (%)',
            'account' => null,
            'group_name' => null,
            'format' => 'percentage',
            'row_class' => 'data-row',
            'is_hidden' => false,
            'required' => true,
        ];

        foreach ($this->slots as $slot => $val) {
            $result[$slot] = $this->net_income_percentage_formula($net_income[$slot],$income[$slot]);
        }
        
        return $result;
    }
    
    protected function current_ratio_row($total_current_assets, $short_term_liabilities, $row, $company, $section, $year, $depth = 0)
    {
        
        $result = [
            'row' => $row,
            'company_id' => $company->id,
            'group_id' => null,
            'category_id' => null,
            'type' => 'ratio',
            'year' => $year,
            'depth' => $depth,
            'level' => $depth + 1,
            'section' => $section,
            'name' => 'Current Ratio',
            'account' => null,
            'group_name' => null,
            'format' => 'number',
            'row_class' => 'data-row',
            'is_hidden' => false,
            'required' => true,
        ];

        foreach ($this->slots as $slot => $val) {
            $result[$slot] = $this->current_ratio_formula($total_current_assets[$slot], $short_term_liabilities[$slot]);
        }
        
        return $result;
    }
    protected function working_capital_row($total_current_assets, $short_term_liabilities, $row, $company, $section, $year, $depth = 0)
    {
        $result = [
            'row' => $row,
            'company_id' => $company->id,
            'group_id' => null,
            'category_id' => null,
            'type' => 'ratio',
            'year' => $year,
            'depth' => $depth,
            'level' => $depth + 1,
            'section' => $section,
            'name' => 'Working Capital',
            'account' => null,
            'group_name' => null,
            'format' => 'currency',
            'row_class' => 'data-row',
            'is_hidden' => false,
            'required' => true,
        ];

        foreach ($this->slots as $slot => $val) {
            $result[$slot] = $this->working_capital_formula($total_current_assets[$slot], $short_term_liabilities[$slot]);
        }
        
        return $result;
    }
    protected function cash_ratio_row($cash_and_cash_equivalents, $short_term_assets_listed_stock_exchange, $short_term_liabilities, $row, $company, $section, $year, $depth = 0)
    {
        $result = [
            'row' => $row,
            'company_id' => $company->id,
            'group_id' => null,
            'category_id' => null,
            'type' => 'ratio',
            'year' => $year,
            'depth' => $depth,
            'level' => $depth + 1,
            'section' => $section,
            'name' => 'Cash Ratio',
            'account' => null,
            'group_name' => null,
            'format' => 'currency',
            'row_class' => 'data-row',
            'is_hidden' => false,
            'required' => true,
        ];

        foreach ($this->slots as $slot => $val) {
            $result[$slot] = $this->cash_ratio_formula($cash_and_cash_equivalents[$slot], $short_term_assets_listed_stock_exchange[$slot], $short_term_liabilities[$slot]);
        }
        
        return $result;
    }

    protected function return_on_equity_row($net_income, $total_equity, $row, $company, $section, $year, $depth = 0)
    {
        $result = [
            'row' => $row,
            'company_id' => $company->id,
            'group_id' => null,
            'category_id' => null,
            'type' => 'ratio',
            'year' => $year,
            'depth' => $depth,
            'level' => $depth + 1,
            'section' => $section,
            'name' => 'Return on Equity',
            'account' => null,
            'group_name' => null,
            'format' => 'percentage',
            'row_class' => 'data-row',
            'is_hidden' => false,
            'required' => true,
        ];

        foreach ($this->slots as $slot => $val) {
            $result[$slot] = $this->return_on_equity_formula($net_income[$slot], $total_equity[$slot]);
        }
        
        return $result;
    }
    protected function debt_to_equity_row($total_liabilities, $total_equity, $row, $company, $section, $year, $depth = 0)
    {
        $result = [
            'row' => $row,
            'company_id' => $company->id,
            'group_id' => null,
            'category_id' => null,
            'type' => 'ratio',
            'year' => $year,
            'depth' => $depth,
            'level' => $depth + 1,
            'section' => $section,
            'name' => 'Debt to Equity',
            'account' => null,
            'group_name' => null,
            'format' => 'number',
            'row_class' => 'data-row',
            'is_hidden' => false,
            'required' => true,
        ];

        foreach ($this->slots as $slot => $val) {
            $result[$slot] = $this->return_on_equity_formula($total_liabilities[$slot], $total_equity[$slot]);
        }
        
        return $result;
    }
    protected function interest_coverage_row($net_income, $ebit_financial_cost, $ebit_taxes, $interest_expenses, $row, $company, $section, $year, $depth = 0)
    {
        $result = [
            'row' => $row,
            'company_id' => $company->id,
            'group_id' => null,
            'category_id' => null,
            'type' => 'ratio',
            'year' => $year,
            'depth' => $depth,
            'level' => $depth + 1,
            'section' => $section,
            'name' => 'Interest Coverage',
            'account' => null,
            'group_name' => null,
            'format' => 'number',
            'row_class' => 'data-row',
            'is_hidden' => false,
            'required' => true,
        ];

        foreach ($this->slots as $slot => $val) {
            $result[$slot] = $this->interest_coverage_formula($net_income[$slot], $ebit_financial_cost[$slot],$ebit_taxes[$slot],$interest_expenses[$slot]);
        }
        
        return $result;
    }
    protected function nopat_row($operative_income, $effective_tax_rate, $row, $company, $section, $year, $depth = 0)
    {
        $result = [
            'row' => $row,
            'company_id' => $company->id,
            'group_id' => null,
            'category_id' => null,
            'type' => 'ratio',
            'year' => $year,
            'depth' => $depth,
            'level' => $depth + 1,
            'section' => $section,
            'name' => 'NOPAT',
            'account' => null,
            'group_name' => null,
            'format' => 'currency',
            'row_class' => 'data-row',
            'is_hidden' => false,
            'required' => true,
        ];

        foreach ($this->slots as $slot => $val) {
            $result[$slot] = $this->nopat_formula($operative_income[$slot], $effective_tax_rate);
        }
        
        return $result;
    }
    protected function roic_row($operative_income, $effective_tax_rate, $total_liabilities, $total_equity, $cash_and_cash_equivalents, $row, $company, $section, $year, $depth = 0)
    {
        $result = [
            'row' => $row,
            'company_id' => $company->id,
            'group_id' => null,
            'category_id' => null,
            'type' => 'ratio',
            'year' => $year,
            'depth' => $depth,
            'level' => $depth + 1,
            'section' => $section,
            'name' => 'ROIC',
            'account' => null,
            'group_name' => null,
            'format' => 'percentage',
            'row_class' => 'data-row',
            'is_hidden' => false,
            'required' => true,
        ];

        foreach ($this->slots as $slot => $val) {
            $result[$slot] = $this->roic_formula($operative_income[$slot], $effective_tax_rate, $total_liabilities[$slot], $total_equity[$slot], $cash_and_cash_equivalents[$slot]);
        }
        
        return $result;
    }
    protected function adjusted_equity_row($total_equity, $net_income, $row, $company, $section, $year, $depth = 0)
    {
        $result = [
            'row' => $row,
            'company_id' => $company->id,
            'group_id' => null,
            'category_id' => null,
            'type' => 'ratio',
            'year' => $year,
            'depth' => $depth,
            'level' => $depth + 1,
            'section' => $section,
            'name' => 'Adjusted Equity',
            'account' => null,
            'group_name' => null,
            'format' => 'currency',
            'row_class' => 'data-row',
            'is_hidden' => false,
            'required' => true,
        ];

        foreach ($this->slots as $slot => $val) {
            $result[$slot] = $this->adjusted_equity_formula($total_equity[$slot], $net_income[$slot]);
        }
        
        return $result;
    }
    protected function book_value_per_share_row($total_equity, $net_income, $number_of_shares, $row, $company, $section, $year, $depth = 0)
    {
        $result = [
            'row' => $row,
            'company_id' => $company->id,
            'group_id' => null,
            'category_id' => null,
            'type' => 'ratio',
            'year' => $year,
            'depth' => $depth,
            'level' => $depth + 1,
            'section' => $section,
            'name' => 'Book Value Per Share',
            'account' => null,
            'group_name' => null,
            'format' => 'currency',
            'row_class' => 'data-row',
            'is_hidden' => false,
            'required' => true,
        ];

        foreach ($this->slots as $slot => $val) {
            $result[$slot] = $this->book_value_per_share_formula($total_equity[$slot], $net_income[$slot], $number_of_shares);
        }
        
        return $result;
    }
}
