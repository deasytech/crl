<?php

namespace App\Console\Commands;

use App\Models\HomepageSetting;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Service;
use App\Models\TeamMember;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('crl:optimise-images')]
#[Description('Generate WebP and responsive derivatives for existing uploads. Originals are never changed.')]
class OptimiseImages extends Command
{
    public function handle(): int
    {
        $count = 0;

        /** @var list<class-string<Project|ProjectImage|Service|TeamMember|HomepageSetting>> $models */
        $models = [Project::class, ProjectImage::class, Service::class, TeamMember::class, HomepageSetting::class];

        foreach ($models as $class) {
            $class::query()->each(function ($model) use (&$count) {
                $model->syncOptimisedImages();
                $count++;
            });
        }

        $this->info("Checked {$count} records.");

        return self::SUCCESS;
    }
}
