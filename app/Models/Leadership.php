<?php

namespace App\Models;

use App\Models\Address;
use App\Models\Community;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Leadership extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'community_id',
        'birthdate',
        'is_active',
        'gender',
        'mobile',
        'business_phone',
        'home_phone',
        'email',
        'photo',
        'address_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'birthdate' => 'date',
            'is_active' => 'boolean',
            'gender' => 'string',
        ];
    }

    /**
     * @return BelongsTo
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    } 

    /**
     * [Description for community]
     *
     * @return BelongsTo
     * 
     */
    public function community(): BelongsTo
    {
        return $this->belongsTo(Community::class);
    } 

}
