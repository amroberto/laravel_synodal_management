<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Beneficiary extends Model
{
    protected $fillable = [
        'corporate_name',
        'fantasy_name',
        'document',
        'phone',
        'mobile',
        'site',
        'email',
        'address_id',
    ];
    
    /**
     * @return BelongsTo
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    } 
}
