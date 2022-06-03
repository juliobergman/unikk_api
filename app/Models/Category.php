<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;
use App\Http\Controllers\ExtractController;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Category extends Model
{
    use SoftDeletes, CascadeSoftDeletes, HasFactory, HasRecursiveRelationships;

    protected $fillable = [
        'name',
        'format',
        'account',
        'company_id',
        'parent_id',
        'group_id',
        'type',
        'sort',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        // 'default',
        'deleted_at',
        'group'
    ];

    protected $casts = [
    ];

    protected $appends = [
        'label',
        'group_name',
    ];
    // Attributes
    public function getLabelAttribute()
    {
        return $this->name;
    }

    public function getGroupNameAttribute()
    {
        return $this->group->name;
    }


    // relationships
    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function facts()
    {
        return $this->hasMany(Fact::class);
    }
    public function childrenFacts()
    {
        return $this->hasManyThrough(Fact::class, Category::class, 'parent_id', 'category_id','id','id');
    }
    public function adjFacts()
    {
        return $this->hasManyOfDescendantsAndSelf(Fact::class);
    }
}
