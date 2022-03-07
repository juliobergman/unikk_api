<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Membership extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'job_title',
        'default',
        'role',
    ];

    protected $hidden = [
        'default',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'selected' => 'boolean'
    ];

    protected $appends = [
        'role_name'
    ];

    public function getRoleNameAttribute()
    {
        return ucwords($this->role);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
