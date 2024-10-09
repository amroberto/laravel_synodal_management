<?php

namespace App\Models;

use App\Models\City;
use App\Models\Community;
use App\Models\Leadership;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
        'address_number',
        'complement',
        'neighborhood',
        'postal_code',
        'city_id',
    ];

    /**
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * @return BelongsTo
     */
    public function community(): HasOne
    {
        return $this->hasOne(Community::class);
    }

    /**
     * @return BelongsTo
     */
    public function leadership(): BelongsTo
    {
        return $this->belongsTo(Leadership::class);
    }
}
