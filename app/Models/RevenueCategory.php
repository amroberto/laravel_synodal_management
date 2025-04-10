<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RevenueCategory extends Model
{
    protected $fillable = [
        'name',
    ];

    public $timestamps = true;

    public function revenues()
    {
        return $this->hasMany(Revenue::class);
    }
    
    public function subCategories()
{
    return $this->hasMany(RevenueSubCategory::class);
}
}
