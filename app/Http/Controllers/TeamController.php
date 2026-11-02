<?php

namespace App\Http\Controllers;

use App\Enums\TeamGroup;
use App\Models\TeamMember;
use Illuminate\View\View;

class TeamController extends Controller
{
    public function __invoke(): View
    {
        $members = TeamMember::published()->ordered()->get();

        return view('pages.team', [
            'core' => $members->where('group', TeamGroup::Core),
            'affiliates' => $members->where('group', TeamGroup::Affiliate)->groupBy('professional_category'),
        ]);
    }
}
