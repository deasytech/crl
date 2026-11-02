<?php

namespace App\Filament\Widgets;

use App\Enums\EnquiryStatus;
use App\Filament\Resources\ContactEnquiries\ContactEnquiryResource;
use App\Filament\Resources\Projects\ProjectResource;
use App\Filament\Resources\Services\ServiceResource;
use App\Models\ContactEnquiry;
use App\Models\Project;
use App\Models\Service;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CrlOverview extends StatsOverviewWidget
{
    protected ?string $heading = 'At a glance';

    /**
     * @return array<int, Stat>
     */
    protected function getStats(): array
    {
        $publishedProjects = Project::query()->whereNotNull('published_at')->where('published_at', '<=', now())->count();
        $draftProjects = Project::query()->count() - $publishedProjects;
        $newEnquiries = ContactEnquiry::query()->where('status', EnquiryStatus::New)->count();

        return [
            Stat::make('Published projects', $publishedProjects)
                ->description($draftProjects.' draft or scheduled')
                ->icon('heroicon-o-building-office-2')
                ->url(ProjectResource::getUrl()),
            Stat::make('Services', Service::query()->count())
                ->description('Managed in Content')
                ->icon('heroicon-o-wrench-screwdriver')
                ->url(ServiceResource::getUrl()),
            Stat::make('New enquiries', $newEnquiries)
                ->description($newEnquiries > 0 ? 'Awaiting a response' : 'Inbox is clear')
                ->color($newEnquiries > 0 ? 'warning' : 'success')
                ->icon('heroicon-o-inbox-arrow-down')
                ->url(ContactEnquiryResource::getUrl()),
        ];
    }
}
