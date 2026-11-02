<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    /** Lists static pages plus published projects and services only. */
    public function sitemap(): Response
    {
        $entries = collect(['home', 'company', 'services.index', 'projects.index', 'team', 'contact'])
            ->map(fn (string $name) => ['loc' => route($name), 'lastmod' => null])
            ->concat(Service::published()->get(['slug', 'updated_at'])->map(fn (Service $s) => ['loc' => route('services.show', $s->slug), 'lastmod' => $s->updated_at]))
            ->concat(Project::published()->get(['slug', 'updated_at'])->map(fn (Project $p) => ['loc' => route('projects.show', $p->slug), 'lastmod' => $p->updated_at]));

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n".view('sitemap', ['entries' => $entries])->render();

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }
}
