<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyData extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_id',
        'country',
        'logo',
    ];
    protected $hidden = [
        'company_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
