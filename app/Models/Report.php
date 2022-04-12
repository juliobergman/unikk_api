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
        'result_field',
        'type',
        'year',
        'depth',
        'section',
        'name',
        'account',
        'format',
        'branch',
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
    ];

    protected $casts = [
        'is_hidden' => 'boolean'
    ];
}
