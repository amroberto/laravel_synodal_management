<?php

namespace App\Models;

use App\Models\Parish;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Community extends Model
{
    use HasFactory;

    protected $fillable = [
        'corporate_name',
        'fantasy_name',
        'document',
        'parish_id',
        'phone',
        'email',
        'address_id',
    ];

    /**
     * @return HasOne
     */
    public function parish(): HasOne
    {
        return $this->hasOne(Parish::class);
    }

    /**
     * @return HasOne
     */
    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }
}
