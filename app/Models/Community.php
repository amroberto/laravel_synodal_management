<?php

namespace App\Models;

use App\Models\Address;
use App\Models\Leadership;
use App\Enums\UnityTypeEnum;
use App\Models\CommunityLeadership;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Community extends Model
{
    use HasFactory;

    protected $fillable = [
        'corporate_name',
        'fantasy_name',
        'document',
        'unity_type',
        'phone',
        'mobile',
        'email',
        'address_id',
    ];

    public $timestamps = true;

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
     * [Description for communityLeaderships]
     *
     * @return HasMany
     * 
     */
    public function communityLeaderships():HasMany
    {
        return $this->hasMany(CommunityLeadership::class);
    }
}
