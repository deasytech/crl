<?php

namespace App\Http\Controllers;

use App\Models\SitePage;
use Illuminate\View\View;

class PrivacyController extends Controller
{
    public function __invoke(): View
    {
        $page = SitePage::get('privacy');

        abort_if(blank($page->body), 404);

        return view('pages.privacy', ['page' => $page]);
    }
}
