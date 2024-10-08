<?php

namespace App\Models;

use App\Models\City;
use App\Models\Community;
use App\Models\Leadership;
use Illuminate\Database\Eloquent\Model;
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
        'community_id',
        'leadership_id',
    ];

    /**
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id'); 
    }

    /**
     * @return BelongsTo
     */
    public function community(): BelongsTo
    {
        return $this->belongsTo(Community::class);
    }

    /**
     * @return [type]
     */
    public function leadership()
    {
        return $this->belongsTo(Leadership::class);
    }
}
