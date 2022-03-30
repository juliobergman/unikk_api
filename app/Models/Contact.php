<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'currency_id',
        'company_id',
        'type',
    ];

    protected $hidden = [
        
    ];

    protected $appends = [
        'is_owned',
        'is_public'
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
    public function getIsPublicAttribute()
    {
        return $this->public ? true : false;
    }
}
