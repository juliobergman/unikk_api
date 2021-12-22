<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'currency_id',
        'company_id',
        'type',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    public function CompanyData(){
        return $this->hasOne(CompanyData::class);
    }

    public function CompanyTargetData(){
        return $this->hasOne(CompanyTargetData::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    public function membership()
    {
        return $this->hasOne(Membership::class);
    }

    public function company()
    {
        return $this->belongsTo(self::class, 'company_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'company_id');
    }
}
