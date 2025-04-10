<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RevenueSubCategory;
use App\Models\Revenue;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class RevenueDetail extends Model
{
    /** @use HasFactory<\Database\Factories\RevenueDetailsFactory> */
    use HasFactory;

    protected $fillable = [
        'revenue_id',
        'revenue_sub_category_id',
        'amount',
    ];


    /**
     * [Description for revenue]
     *
     * @return BelongsTo
     *
     */
    public function revenue():BelongsTo
    {
        return $this->belongsTo(Revenue::class);
    }

    /**
     * [Description for revenueSubcategory]
     *
     * @return BelongsTo
     *
     */
    public function subCategory():BelongsTo
    {
        return $this->belongsTo(RevenueSubcategory::class, 'revenue_sub_category_id');
    }

    public function category(): HasOneThrough
    {
        return $this->hasOneThrough(
            RevenueCategory::class,
            RevenueSubCategory::class,
            'id', // foreign key on RevenueSubCategory
            'id', // foreign key on RevenueCategory
            'revenue_sub_category_id', // local key on RevenueDetail
            'revenue_category_id' // local key on RevenueSubCategory
        );
    }
}
