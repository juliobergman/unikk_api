<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'row',
        'company_id',
        'category_id',
        'type',
        'year',
        'depth',
        'level',
        'section',
        'name',
        'account',
        'format',
        'row_class',
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
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'jan' => 'float',
        'feb' => 'float',
        'mar' => 'float',
        'qr1' => 'float',
        'apr' => 'float',
        'may' => 'float',
        'jun' => 'float',
        'qr2' => 'float',
        'jul' => 'float',
        'aug' => 'float',
        'sep' => 'float',
        'qr3' => 'float',
        'oct' => 'float',
        'nov' => 'float',
        'dec' => 'float',
        'qr4' => 'float',
        'yar' => 'float',
        'is_hidden' => 'boolean',
        'created_at' => 'datetime:F j, Y, g:i a',
        'updated_at' => 'datetime:F j, Y, g:i a',
    ];
}
