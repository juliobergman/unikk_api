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
        'public',
        'name',
        'company',
        'email',
        'phone',
        'address',
        'notes',
        'profile_pic',
    ];

    protected $hidden = [
        
    ];

    protected $appends = [
        'is_owned',
        'is_public',
        'avatar'
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
    public function getAvatarAttribute()
    {
        return $this->profile_pic ? $this->profile_pic : '/storage/factory/avatar/misc/avatar-user.jpg';
    }
}
