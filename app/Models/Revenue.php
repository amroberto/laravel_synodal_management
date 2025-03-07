<?php

namespace App\Models;

use App\Models\User;
use App\Models\Community;
use App\Models\RevenueItens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Revenue extends Model
{
    protected $fillable = [
        'user_id',
        'community_id',
        'dt_revenue',
        'reference_month',
        'reference_year',
        'total_revenue',
        'tithe',
        'other',
        'total_offers',
        'month',
        'year',
        'observation'
    ];

    /**
     * [Description for user]
     *
     * @return BelongsTo
     * 
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * [Description for community]
     *
     * @return BelongsTo
     * 
     */
    public function community(): BelongsTo
    {
        return $this->belongsTo(Community::class);
    }

    /**
     * [Description for revenueItens]
     *
     * @return HasMany
     * 
     */
    public function revenueItens(): HasMany
    {
        return $this->hasMany(RevenueItens::class);
    }
}
