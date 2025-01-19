<?php

namespace App\Models;

use App\Models\State;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ibge_code',
        'state_id'
    ];

    /**
     * [Description for state]
     *
     * @return BelongsTo
     * 
     */
    public function state():BelongsTo
    {
        return $this->belongsTo(State::class);
    }

}