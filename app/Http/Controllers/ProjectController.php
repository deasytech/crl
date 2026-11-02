<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /** Filtering is a plain `?category=slug` query so it works without JavaScript and can be linked to. */
    public function index(Request $request): View
    {
        $categories = ProjectCategory::whereHas('projects', fn ($query) => $query->published())
            ->orderBy('sort_order')
            ->get();

        $active = $categories->firstWhere('slug', $request->query('category'));

        $projects = Project::published()
            ->ordered()
            ->with('category')
            ->when($active, fn ($query) => $query->where('project_category_id', $active->id))
            ->get();

        return view('pages.projects.index', compact('categories', 'active', 'projects'));
    }

    public function show(Project $project): View
    {
        abort_unless($project->isPublished(), 404);

        $project->load('category', 'images');

        $neighbours = Project::published()->ordered()->get(['id', 'title', 'slug']);
        $position = $neighbours->search(fn (Project $other) => $other->is($project));

        return view('pages.projects.show', [
            'project' => $project,
            'previous' => $position > 0 ? $neighbours[$position - 1] : null,
            'next' => $neighbours[$position + 1] ?? null,
        ]);
    }
}
