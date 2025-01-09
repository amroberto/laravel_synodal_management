<?php

namespace App\Models;

use App\Models\Address;
use App\Enums\UnityTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Community extends Model
{
    use HasFactory;

    protected $fillable = [
        'corporate_name',
        'fantasy_name',
        'document',
        'unity_type',
        'phone',
        'email',
        'address_id',
    ];

    protected $casts = [
        'unity_type' => UnityTypeEnum::class,
    ];


    /**
     * @return BelongsTo
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    } 
    
   /**
    * [Description for leadershipies]
    *
    * @return HasMany
    * 
    */
   public function leaderships(): HasMany
   {
       return $this->hasMany(Leadership::class);
   }
}
