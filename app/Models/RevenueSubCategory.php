<?php

namespace App\Models;

use App\Models\RevenueCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RevenueSubCategory extends Model
{
    protected $fillable = [
        'name',
        'revenue_category_id'
    ];

    public $timestamps = true;


    /**
     * [Description for revenue_category]
     *
     * @return BelongsTo
     * 
     */
    public function revenue_category():BelongsTo
    {
        return $this->belongsTo(RevenueCategory::class);
    }
}
