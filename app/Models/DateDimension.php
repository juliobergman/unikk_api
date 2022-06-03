<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateDimension extends Model
{
    use HasFactory;

    protected $hidden = [
        'id',
        'day',
        // 'month',
        // 'year',
        'day_name',
        'day_suffix',
        'day_of_week',
        'day_of_year',
        'is_weekend',
        'week',
        'iso_week',
        'week_of_month',
        'week_of_year',
        'iso_week_in_year',
        // 'month_name',
        // 'month_name_short',
        'month_year',
        'month_name_year',
        'first_day_of_month',
        'last_day_of_month',
        'first_day_of_next_month',
        // 'quarter',
        // 'quarter_name',
        'first_day_of_quarter',
        'last_day_of_quarter',
        'first_day_of_year',
        'last_day_of_year',
        'first_day_of_next_year',
        'dow_in_month',
        'created_at',
        'updated_at',
    ];
}
