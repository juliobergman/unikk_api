<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Company;
use App\Models\Formula;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FormulaController extends Controller
{
    
    protected $slots =  [
        'jan' => 0,
        'feb' => 0,
        'mar' => 0,
        'qr1' => 0,
        'apr' => 0,
        'may' => 0,
        'jun' => 0,
        'qr2' => 0,
        'jul' => 0,
        'aug' => 0,
        'sep' => 0,
        'qr3' => 0,
        'oct' => 0,
        'nov' => 0,
        'dec' => 0,
        'qr4' => 0,
        'yar' => 0,
    ];

    protected $ebit_slots = [
        'net_income',
        'ebit_financial_cost',
        'ebit_taxes',
        'ebit_da',
    ];
    
    // Formulas
    protected function ebit_formula($net, $cost, $taxes)
    {
        $a = (float)$net;
        $b = (float)$cost * -1;
        $c = (float)$taxes * -1;   
        return $a + $b + $c;
    }

    protected function ebitda_formula($net, $cost, $taxes, $da)
    {
        $ebit = $this->ebit_formula($net, $cost, $taxes);
        $d = (float)$da;
        return $ebit - $d;
    }
    protected function ebitda_percentage_formula($net, $cost, $taxes, $da, $income)
    {
        $ebitda = $this->ebitda_formula($net, $cost, $taxes, $da);
        $i = (float)$income;
        if(!$i) return 0;
        return $ebitda / $i;
    }
    protected function current_ratio_formula($total_current_assets, $short_term_liabilities)
    {
        $a = (float)$total_current_assets;
        $b = (float)$short_term_liabilities;
        if(!$b) return 0;
        return $a / $b;
    }
    protected function working_capital_formula($total_current_assets, $short_term_liabilities)
    {
        $a = (float)$total_current_assets;
        $b = (float)$short_term_liabilities;
        return $a - $b;
    }
    protected function cash_ratio_formula($cash_and_cash_equivalents, $short_term_assets_listed_stock_exchange, $short_term_liabilities)
    {
        $a = (float)$cash_and_cash_equivalents;
        $b = (float)$short_term_assets_listed_stock_exchange;
        $c = (float)$short_term_liabilities;
        if(!$c) return 0;
        return ($a + $b) / $c;
    }
    protected function net_income_percentage_formula($net_income, $income)
    {
        $a = (float)$net_income;
        $b = (float)$income;
        if(!$b) return 0;
        return $a / $b;
    }
    protected function gross_profit_percentage_formula($gross_profit, $income)
    {
        $a = (float)$gross_profit;
        $b = (float)$income;
        if(!$b) return 0;
        return $a / $b;
    }
    protected function return_on_equity_formula($net_income, $total_equity)
    {
        $a = (float)$net_income;
        $b = (float)$total_equity;
        if(!$b) return 0;
        return $a / $b;
    }
    protected function nopat_formula($operative_income, $effective_tax_rate)
    {
        $a = (float)$operative_income;
        $b = 1 - (float)$effective_tax_rate;
        return $a * $b;
    }
    protected function roic_formula($operative_income, $effective_tax_rate, $total_liabilities, $total_equity, $cash_and_cash_equivalents)
    {
        $nopat = $this->nopat_formula($operative_income, $effective_tax_rate);
        $a = (float)$total_equity;
        $b = (float)$total_liabilities;
        $c = (float)$cash_and_cash_equivalents;
        $d = $a + $b - $c;
        if(!$d || $d === 0) return 0;
        return $nopat / $d;
    }
    protected function adjusted_equity_formula($total_equity, $net_income)
    {
        $a = (float)$total_equity;
        $b = (float)$net_income;
        return $a + $b;
    }
    protected function debt_to_equity_formula($total_liabilities, $total_equity)
    {
        $a = (float)$total_liabilities;
        $b = (float)$total_equity;
        if(!$b) return 0;
        return $a / $b;
    }
    protected function interest_coverage_formula($net_income, $financial_cost, $taxes, $interest_expenses)
    {
        $ebit = $this->ebit_formula($net_income, $financial_cost, $taxes);
        $a = (float)$interest_expenses;
        if(!$a) return 0;
        return $ebit / $a;
    }
    
    protected function book_value_per_share_formula($total_equity, $net_income, $number_of_shares)
    {   
        $a = $this->adjusted_equity_formula($total_equity, $net_income);
        $b = (float)$number_of_shares;
        if(!$b) return 0;
        return $a / $b;
    }
}
