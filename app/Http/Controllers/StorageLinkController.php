<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Throwable;

/**
 * Creates the public/storage symlink for hosts without shell access. Admin-only.
 */
class StorageLinkController extends Controller
{
    public function __invoke(Request $request): string
    {
        abort_unless($request->user()?->isAdmin(), 403);

        if (file_exists(public_path('storage'))) {
            return 'The storage link already exists. Nothing to do.';
        }

        try {
            Artisan::call('storage:link');
        } catch (Throwable $e) {
            report($e);

            return 'Could not create the storage link: '.$e->getMessage();
        }

        return trim(Artisan::output()) ?: 'The storage link has been created.';
    }
}
