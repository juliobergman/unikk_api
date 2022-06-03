<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fact extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'category_id',
        'company_id',
        'amount',
    ];

    protected $hidden = [
        'fulldate'
    ];

    protected $casts = [
        'amount' => 'decimal: 2'
    ];

    protected $appends = [
    // 'group_month',
    // 'day',
    'month',
    'year',
    // 'day_name',
    // 'day_suffix',
    // 'day_of_week',
    // 'day_of_year',
    // 'is_weekend',
    // 'week',
    // 'iso_week',
    // 'week_of_month',
    // 'week_of_year',
    // 'iso_week_in_year',
    // 'month_name',
    // 'month_name_short',
    // 'month_year',
    // 'month_name_year',
    // 'first_day_of_month',
    // 'last_day_of_month',
    // 'first_day_of_next_month',
    'quarter',
    // 'quarter_name',
    // 'first_day_of_quarter',
    // 'last_day_of_quarter',
    // 'first_day_of_year',
    // 'last_day_of_year',
    // 'first_day_of_next_year',
    // 'dow_in_month',
    ];
    // Attributes
    public function getDayAttribute()
    {
        return $this->fulldate->day;
    }
    public function getMonthAttribute()
    {
        return $this->fulldate->month;
    }
    public function getYearAttribute()
    {
        return $this->fulldate->year;
    }
    public function getDayNameAttribute()
    {
        return $this->fulldate->day_name;
    }
    public function getDaySuffixAttribute()
    {
        return $this->fulldate->day_suffix;
    }
    public function getDayOfWeekAttribute()
    {
        return $this->fulldate->day_of_week;
    }
    public function getDayOfYearAttribute()
    {
        return $this->fulldate->day_of_year;
    }
    public function getIsWeekendAttribute()
    {
        return $this->fulldate->is_weekend;
    }
    public function getWeekAttribute()
    {
        return $this->fulldate->week;
    }
    public function getIsoWeekAttribute()
    {
        return $this->fulldate->iso_week;
    }
    public function getWeekOfMonthAttribute()
    {
        return $this->fulldate->week_of_month;
    }
    public function getWeekOfYearAttribute()
    {
        return $this->fulldate->week_of_year;
    }
    public function getIsoWeekInYearAttribute()
    {
        return $this->fulldate->iso_week_in_year;
    }
    public function getMonthNameAttribute()
    {
        return $this->fulldate->month_name;
    }
    public function getMonthNameShortAttribute()
    {
        return $this->fulldate->month_name_short;
    }
    public function getMonthYearAttribute()
    {
        return $this->fulldate->month_year;
    }
    public function getMonthNameYearAttribute()
    {
        return $this->fulldate->month_name_year;
    }
    public function getFirstDayOfMonthAttribute()
    {
        return $this->fulldate->first_day_of_month;
    }
    public function getLastDayOfMonthAttribute()
    {
        return $this->fulldate->last_day_of_month;
    }
    public function getFirstDayOfNextMonthAttribute()
    {
        return $this->fulldate->first_day_of_next_month;
    }
    public function getQuarterAttribute()
    {
        return $this->fulldate->quarter;
    }
    public function getQuarterNameAttribute()
    {
        return $this->fulldate->quarter_name;
    }
    public function getFirstDayOfQuarterAttribute()
    {
        return $this->fulldate->first_day_of_quarter;
    }
    public function getLastDayOfQuarterAttribute()
    {
        return $this->fulldate->last_day_of_quarter;
    }
    public function getFirstDayOfYearAttribute()
    {
        return $this->fulldate->first_day_of_year;
    }
    public function getLastDayOfYearAttribute()
    {
        return $this->fulldate->last_day_of_year;
    }
    public function getFirstDayOfNextYearAttribute()
    {
        return $this->fulldate->first_day_of_next_year;
    }
    public function getDowInMonthAttribute()
    {
        return $this->fulldate->dow_in_month;
    }
    public function getGroupMonthAttribute()
    {
        $date = new DateTime($this->date);
        return $date->format('n');
    }


    // Relationships
    public function fact()
    {
        return $this;
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function fulldate()
    {
        return $this->belongsTo(DateDimension::class, 'date', 'date');
    }
}
