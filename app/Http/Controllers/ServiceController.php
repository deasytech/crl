<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /** Services whose documented project role maps directly to a `crl_involvement` value. */
    private const INVOLVEMENT = ['architecture' => 'Design', 'construction' => 'Construction'];

    public function index(): View
    {
        return view('pages.services.index', ['services' => Service::published()->ordered()->get()]);
    }

    public function show(Service $service): View
    {
        abort_unless($service->isPublished(), 404);

        $involvement = self::INVOLVEMENT[$service->slug] ?? null;

        return view('pages.services.show', [
            'service' => $service,
            'others' => Service::published()->ordered()->whereKeyNot($service->getKey())->get(),
            'projects' => $involvement
                ? Project::published()->ordered()->with('category')->where('crl_involvement', $involvement)->whereNotNull('main_image')->limit(3)->get()
                : collect(),
        ]);
    }
}
