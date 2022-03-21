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
        // 'deleted_at',
    ];

    protected $casts = [
        'selected' => 'boolean',
        'created_at' => 'datetime:F j, Y, g:i a',
    ];

    protected $appends = [
        // 'email_verified',
        'role_name',
        'is_admin',
        'is_editor',
        'is_user',
    ];



    // Attributes
    public function getRoleNameAttribute()
    {
        return ucwords($this->role);
    }
    public function getIsAdminAttribute()
    {
        return $this->role == 'admin' ? true : false;
    }
    public function getIsEditorAttribute()
    {
        return $this->role == 'editor' || $this->role == 'admin' ? true : false;
    }
    public function getIsUserAttribute()
    {
        return $this->role == 'user' || $this->role == 'editor' || $this->role == 'admin' ? true : false;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function pat()
    {
        return $this->hasMany(Pat::class, 'tokenable_id', 'user_id');
    }
}
