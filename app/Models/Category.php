<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ExtractController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Category extends Model
{
    use HasFactory, HasRecursiveRelationships;

    protected $fillable = [
        'name',
        'company_id',
        'parent_id'
    ];

    protected $hidden = [
        // 'default',
        'deleted_at',
    ];

    protected $casts = [
    ];

    protected $appends = [
        // 'label',
        // 'fact_data',
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
        'branch',

    ];
    // Attributes
    public function getLabelAttribute()
    {
        return $this->name;
    }

    public function getJanAttribute()
    {  
        return $this->fact_data
        ->where('month', 1)->sum('amount');
    }
    public function getFebAttribute()
    {  
        return $this->fact_data
            ->where('month', 2)->sum('amount');
    }
    public function getMarAttribute()
    {  
        return $this->fact_data
            ->where('month', 3)->sum('amount');
    }
    public function getQr1Attribute()
    {  
        return $this->fact_data
            ->where('quarter', 1)->sum('amount');
    }
    public function getAprAttribute()
    {  
        return $this->fact_data
            ->where('month', 4)->sum('amount');
    }
    public function getMayAttribute()
    {  
        return $this->fact_data
            ->where('month', 5)->sum('amount');
    }
    public function getJunAttribute()
    {  
        return $this->fact_data
            ->where('month', 6)->sum('amount');
    }
    public function getQr2Attribute()
    {  
        return $this->fact_data
            ->where('quarter', 2)->sum('amount');
    }
    public function getJulAttribute()
    {  
        return $this->fact_data
            ->where('month', 7)->sum('amount');
    }
    public function getAugAttribute()
    {  
        return $this->fact_data
            ->where('month', 8)->sum('amount');
    }
    public function getSepAttribute()
    {  
        return $this->fact_data
            ->where('month', 9)->sum('amount');
    }
    public function getQr3Attribute()
    {  
        return $this->fact_data
            ->where('quarter', 3)->sum('amount');
    }
    public function getOctAttribute()
    {  
        return $this->fact_data
            ->where('month', 10)->sum('amount');
    }
    public function getNovAttribute()
    {  
        return $this->fact_data
            ->where('month', 11)->sum('amount');
    }
    public function getDecAttribute()
    {  
        return $this->fact_data
            ->where('month', 12)->sum('amount');
    }
    public function getQr4Attribute()
    {  
        return $this->fact_data
            ->where('quarter', 4)->sum('amount');
    }
    public function getYarAttribute()
    {  
        return $this->fact_data->sum('amount');
    }

    public function getBranchAttribute()
    {  
        $ra = $this->rootAncestor();
        $branch = null;
        if($ra->count()){
            $branch = $ra->pluck('name');
            $branch = $branch[0];
        }
        return $branch;
    }

    public function getFactDataAttribute()
    {
        return Fact::whereIn('facts.id', $this->facts->pluck('id'))->leftJoin('date_dimensions', 'facts.date', '=', 'date_dimensions.date')->get();
    }

    // Relationships
    public function facts()
    {
        return $this->hasManyOfDescendantsAndSelf(Fact::class);
    }
    protected function fact_ids()
    {
        return $this->facts->pluck('section');
    }
    // public function parent()
    // {
    //     return = $this->rootAncestor();
    // }
}
