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
        'unity_type',
        'phone',
        'email',
        'address_id',
    ];

    protected $casts = [
        'unit_type' => UnitType::class,
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
