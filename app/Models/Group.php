<?php

namespace App\Models;

use App\Models\Leadership;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public $timestamps = true;

    /**
     * [Description for leadership]
     *
     * @return BelongsToMany
     *
     */
    public function leadership(): BelongsToMany
    {
        return $this->BelongsToMany(Leadership::class, 'group_leadership');
    }
}
