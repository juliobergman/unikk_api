<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
        'label',
        // 'is_hidden',
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
        'year',
        'facts'
    ];
    // Attributes
    public function getLabelAttribute()
    {
        return $this->name;
    }

    protected function getAmount($selector = null)
    {
        $amount = $this->facts->map(function ($item, $key) use ($selector) {
            if($item->month == $selector){
                return $item;
            }
            return 0;
        });
        return $amount;
    }

    // Amount Atribbutes
    public function getIsHiddenAttribute()
    {
        return $this->facts->sum('amount') <= 0 ? true : false;
    }

    public function getJanAttribute()
    {  
        return $this->facts
        ->where('month', 1)->sum('amount');
    }
    public function getFebAttribute()
    {  
        return $this->facts
            ->where('month', 2)->sum('amount');
    }
    public function getMarAttribute()
    {  
        return $this->facts
            ->where('month', 3)->sum('amount');
    }
    public function getQr1Attribute()
    {  
        return $this->facts
            ->where('quarter', 1)->sum('amount');
    }
    public function getAprAttribute()
    {  
        return $this->facts
            ->where('month', 4)->sum('amount');
    }
    public function getMayAttribute()
    {  
        return $this->facts
            ->where('month', 5)->sum('amount');
    }
    public function getJunAttribute()
    {  
        return $this->facts
            ->where('month', 6)->sum('amount');
    }
    public function getQr2Attribute()
    {  
        return $this->facts
            ->where('quarter', 2)->sum('amount');
    }
    public function getJulAttribute()
    {  
        return $this->facts
            ->where('month', 7)->sum('amount');
    }
    public function getAugAttribute()
    {  
        return $this->facts
            ->where('month', 8)->sum('amount');
    }
    public function getSepAttribute()
    {  
        return $this->facts
            ->where('month', 9)->sum('amount');
    }
    public function getQr3Attribute()
    {  
        return $this->facts
            ->where('quarter', 3)->sum('amount');
    }
    public function getOctAttribute()
    {  
        return $this->facts
            ->where('month', 10)->sum('amount');
    }
    public function getNovAttribute()
    {  
        return $this->facts
            ->where('month', 11)->sum('amount');
    }
    public function getDecAttribute()
    {  
        return $this->facts
            ->where('month', 12)->sum('amount');
    }
    public function getQr4Attribute()
    {  
        return $this->facts
            ->where('quarter', 4)->sum('amount');
    }
    public function getYearAttribute()
    {  
        return $this->facts->sum('amount');
    }

    public function getFactsAttribute()
    {
        $ids = $this->factsOffspring->modelKeys();
        $facts = Fact::whereIn('facts.id', $ids)
        ->leftJoin('date_dimensions', 'facts.date', '=', 'date_dimensions.date')
        ->select([
            'facts.id',
            'facts.amount',
            'date_dimensions.month',
            'date_dimensions.quarter'
        ])
        ->get();
        return $facts;
    }

    // Relationships
    // public function facts()
    // {
    //     return $this->factsOffspring()->modelKeys();
    //     // return $this->hasMany(Fact::class)->leftJoin('date_dimensions', 'facts.date', '=', 'date_dimensions.date');
    // }

    public function factsOffspring()
    {
        return $this->hasManyOfDescendantsAndSelf(Fact::class);
    }
    public function offspring()
    {
        return $this->children();
    }
}
