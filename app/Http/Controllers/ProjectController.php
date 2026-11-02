<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        return view('pages.projects.index', [
            'categories' => ProjectCategory::orderBy('sort_order')->get(),
            'projects' => Project::published()->ordered()->with('category')->get(),
        ]);
    }

    public function show(Project $project): View
    {
        abort_unless($project->isPublished(), 404);

        return view('pages.projects.show', ['project' => $project->load('category', 'images')]);
    }
}
