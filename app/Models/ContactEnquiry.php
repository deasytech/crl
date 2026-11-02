<?php

namespace App\Models;

use App\Enums\EnquiryStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name', 'email', 'phone', 'organisation', 'service', 'project_location',
    'message', 'status', 'internal_notes', 'ip_hash',
])]
#[Hidden(['ip_hash'])]
class ContactEnquiry extends Model
{
    protected function casts(): array
    {
        return ['status' => EnquiryStatus::class];
    }
}
