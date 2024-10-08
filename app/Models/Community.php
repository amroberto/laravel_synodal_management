<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Address;

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
        'unit_type' => UnitType::class,
    ];

    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
