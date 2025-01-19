<?php

namespace App\Models;

use App\Models\Community;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Position extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * [Description for leaderships]
     *
     * @return BelongsToMany
     * 
     */
    public function leaderships():BelongsToMany
    {
        return $this->belongsToMany(Leadership::class, 'community_leadership')
            ->withTimestamps();
    }
}
