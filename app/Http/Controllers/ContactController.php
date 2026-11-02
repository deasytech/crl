<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ContactController extends Controller
{
    /** The enquiry form itself is implemented in Phase 6. */
    public function show(): View
    {
        return view('pages.contact');
    }
}
