<?php

namespace App\Models;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'abbreviation',
        'country_id'
    ];

    /**
     * [Description for country]
     *
     * @return BelongsTo
     * 
     */
    public function country():BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * [Description for cities]
     *
     * @return HasMany
     * 
     */
    public function cities():HasMany
    {
        return $this->hasMany(City::class);
    }
}
