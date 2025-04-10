<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offer extends Model
{


    protected $fillable = [
        'dt_offer',
        'offer_plan_id',
        'value',
        'month',
        'year',
        'revenue_id',
        'observation',
    ];

    /**
     * [Description for offerPlan]
     *
     * @return BelongsTo
     *
     */
    public function offerPlan(): BelongsTo
    {
        return $this->belongsTo(OfferPlan::class);
    }

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

    public function community()
    {
        return $this->revenue?->community();
    }

}
