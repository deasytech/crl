<?php

namespace App\Console\Commands;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('crl:make-admin {email : Email address of the admin} {--name= : Display name}')]
#[Description('Create or promote an admin-panel user. The password is prompted for, never stored in code.')]
class MakeAdmin extends Command
{
    public function handle(): int
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (! $user) {
            $password = $this->secret('Password (min. 12 characters)');

            if (strlen((string) $password) < 12) {
                $this->error('Password must be at least 12 characters.');

                return self::FAILURE;
            }

            $user = new User(['name' => $this->option('name') ?: $email, 'email' => $email, 'password' => $password]);
        }

        $user->role = UserRole::Admin;
        $user->save();
        $user->markEmailAsVerified();

        $this->info("{$email} is now an admin.");

        return self::SUCCESS;
    }
}
