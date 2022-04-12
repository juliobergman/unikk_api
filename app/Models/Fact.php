<?php

namespace App\Models;

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

    ];

    protected $casts = [
        'amount' => 'decimal: 2'
    ];

    protected $appends = [

    ];
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
