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
    ];

    public function community():HasOne
    {
        return $this->hasOne(Community::class);
    }

    public function address():HasOne
    {
        return $this->hasOne(Address::class);
    }
}
