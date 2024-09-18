<?php

namespace App\Models;

use App\Models\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'abbreviation'
    ];

    /**
     * @return HasOne
     */
    public function city():HasOne
    {
        return $this->hasOne(City::class);
    }
}
