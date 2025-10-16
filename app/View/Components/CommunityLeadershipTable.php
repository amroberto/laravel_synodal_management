<?php

namespace App\View\Components;

use Closure;
use App\Models\Position;
use App\Models\Leadership;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class CommunityLeadershipTable extends Component
{
    public $community;
    public $leaderships;
    public $positions;

    public function __construct($community = null)
    {
        $this->community = $community;
        $this->leaderships = Leadership::all();
        $this->positions = Position::all();
    }

    public function render()
    {
        return view('components.community-leadership-table');
    }
}
