<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Site pages are a fixed set: editors may change their wording, but pages cannot be added or removed.
 */
class SitePagePolicy extends ContentPolicy
{
    public function create(User $user): bool
    {
        return false;
    }

    public function delete(User $user, Model $record): bool
    {
        return false;
    }

    public function deleteAny(User $user): bool
    {
        return false;
    }
}
