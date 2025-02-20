<?php

namespace App\Models;

use App\Models\Address;
use App\Models\Position;
use App\Models\Community;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public $timestamps = true;

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
     * [Description for communities]
     *
     * @return BelongsToMany
     * 
     */
    public function communities(): BelongsToMany
    {
        return $this->belongsToMany(Community::class, 'community_leadership')
            ->withPivot('position_id')
            ->withTimestamps();
    }

    /**
     * [Description for positions]
     *
     * @return BelongsToMany
     * 
     */
    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(Position::class, 'community_leaderships')
            ->withTimestamps();
    }

    /**
     * [Description for community]
     *
     * @return BelongsTo
     * 
     */
    public function community():BelongsTo
    {
        return $this->belongsTo(\App\Models\Community::class);
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'group_leadership');
    }
}
