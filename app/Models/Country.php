<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
    ];

    /**
     * [Description for states]
     *
     * @return HasMany
     * 
     */
    public function states():HasMany
    {
        return $this->hasMany(State::class);
    }
}
