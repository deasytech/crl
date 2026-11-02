<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\TeamMember;
use Illuminate\View\View;

class CompanyController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.company', [
            'services' => Service::published()->ordered()->get(),
            'team' => TeamMember::published()->where('is_featured', true)->ordered()->get(),
        ]);
    }
}
