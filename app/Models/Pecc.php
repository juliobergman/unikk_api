<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pecc extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_id',
        'fund',
        'type',
        'region',
        'based',
        'main_countries',
        'main_cities',
        'sector',
        'geo_focus',
        'notes',
    ];

    protected $appends = [
        'is_owned',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Attributes
    public function getIsOwnedAttribute()
    {
        return Auth::user()->id === $this->user_id ? true : false;
    }
}
