<?php

namespace App\Http\Controllers;

use App\Models\HomepageSetting;
use App\Models\Project;
use App\Models\Service;
use App\Models\TeamMember;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.home', [
            'home' => HomepageSetting::current(),
            'services' => Service::published()->featured()->ordered()->get(),
            'projects' => Project::published()->featured()->ordered()->with('category')->limit(8)->get(),
            'team' => TeamMember::published()->where('is_featured', true)->ordered()->get(),
        ]);
    }
}
