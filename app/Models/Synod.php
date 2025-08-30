<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Synod extends Model
{

    protected $fillable = [
        'corporate_name',
        'trade_name',
        'cnpj',
        'phone',
        'cellphone',
        'cep',
        'address',
        'number',
        'complement',
        'district',
        'city',
        'state',
        'website',
        'email',
        'logo',
    ];

    use HasFactory;
    
    public function getLogoUrlAttribute()
    {
        return $this->logo ? Storage::url($this->logo) : null;
    }

    public function getLogoPathAttribute()
    {
        return $this->logo ? Storage::path($this->logo) : null;
    }
    public function getLogoExistsAttribute()
    {
        return $this->logo ? Storage::exists($this->logo) : false;
    }
}
