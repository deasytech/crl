<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('pages.services.index', ['services' => Service::published()->ordered()->get()]);
    }

    public function show(Service $service): View
    {
        abort_unless($service->isPublished(), 404);

        return view('pages.services.show', ['service' => $service]);
    }
}
