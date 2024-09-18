<?php

namespace App\Models;

use App\Models\Community;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Leadership extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_actice',
        'birthdate',
        'gender',
        'community_id',
        'mobile',
        'business_phone',
        'home_phone',
        'email',
        'address_id',
        'photo',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'gender' => 'boolean',
        ];
    }

    /**
     * @return HasOne
     */
    public function community():HasOne
    {
        return $this->hasOne(Community::class);
    }

    /**
     * @return HasOne
     */
    public function address():HasOne
    {
        return $this->hasOne(Address::class);
    }
}
