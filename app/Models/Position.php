<?php

namespace App\Models;

use App\Models\Community;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Position extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = ['name'];

    public function communityLeaderships()
    {
        return $this->hasMany(CommunityLeadership::class);
    }
}
