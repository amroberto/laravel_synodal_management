<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RevenueItens extends Model
{
    protected $fillable = [
        'revenue_id',
        'revenue_sub_category_id',
        'value',
    ];

    /**
     * [Description for revenue]
     *
     * @return BelongsTo
     * 
     */
    public function revenue(): BelongsTo
    {
        return $this->belongsTo(Revenue::class);
    }

    /**
     * [Description for revenueSubCategory]
     *
     * @return BelongsTo
     * 
     */
    public function revenueSubCategory(): BelongsTo
    {
        return $this->belongsTo(RevenueSubCategory::class);
    }
}
