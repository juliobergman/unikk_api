<?php

namespace App\Http\Controllers;

use App\Models\DateDimension;
use Illuminate\Http\Request;

class DateDimensionController extends Controller
{

    public function index()
    {
        return DateDimension::all();
    }

    public function years()
    {
        $dates = collect(DateDimension::all());
        return $dates->unique('year')->pluck('year');
    }
    public function structure()
    {
        $data = collect(DateDimension::all());

        // return $data;

        $dates = $data->unique('date')->pluck('date');
        $years = $data->unique('year')->pluck('year');
        $months = $data->unique('month')->pluck('month');
        $quarters = $data->unique('quarter')->pluck('quarter');

        return [
            'dates' => $dates,
            'years' => $years,
            'months' => $months,
            'quarters' => $quarters,
        ];

    }
}
