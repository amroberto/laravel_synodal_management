<?php

namespace App\Models;

use App\Models\RevenueDetail;
use App\Models\RevenueCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RevenueSubCategory extends Model
{
    protected $fillable = [
        'name',
        'revenue_category_id'
    ];

    public $timestamps = true;

    /**
     * [Description for category]
     *
     * @return BelongsTo
     * 
     */
    public function category():BelongsTo
    {
        return $this->belongsTo(RevenueCategory::class, 'revenue_category_id');
    }

    /**
     * [Description for revenueDetails]
     *
     * @return HasMany
     * 
     */
    public function revenueDetails():HasMany
    {
        return $this->hasMany(RevenueDetail::class);
    }


}
