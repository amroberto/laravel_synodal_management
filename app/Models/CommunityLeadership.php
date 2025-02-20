<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommunityLeadership extends Model
{
    use HasFactory;

    protected $fillable = [
        'leadership_id',
        'position_id',
        'community_id'
    ];
    
    /**
     * [Description for leadership]
     *
     * @return BelongsTo
     * 
     */
    public function leadership(): BelongsTo
    {
        return $this->belongsTo(Leadership::class);
    }

    /**
     * [Description for position]
     *
     * @return BelongsTo
     * 
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }
}
