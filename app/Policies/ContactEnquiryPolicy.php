<?php

namespace App\Policies;

use App\Models\ContactEnquiry;
use App\Models\User;

/**
 * Enquiries contain personal data, so only admins can read or change them.
 * They are created by the public form only, never from the panel.
 */
class ContactEnquiryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(User $user, ContactEnquiry $enquiry): bool
    {
        return $user->isAdmin();
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, ContactEnquiry $enquiry): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, ContactEnquiry $enquiry): bool
    {
        return $user->isAdmin();
    }

    public function deleteAny(User $user): bool
    {
        return $user->isAdmin();
    }
}
