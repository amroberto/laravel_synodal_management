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
        'address',
        'addressNumber',
        'complement',
        'province',
        'postalCode',
        'city_id',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function leadership():HasOne
    {
        return $this->hasOne(Leadership::class);
    }

    public function community():HasOne
    {
        return $this->hasOne(Community::class);
    }
}
