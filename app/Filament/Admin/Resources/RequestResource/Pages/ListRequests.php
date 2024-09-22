<?php

namespace App\Filament\Admin\Resources\RequestResource\Pages;

use App\Enums\Request\StatusEnum;
use App\Filament\Admin\Resources\RequestResource;
use App\Models\Request;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListRequests extends ListRecords
{
    protected static string $resource = RequestResource::class;

    protected function getHeaderActions(): array
    {



        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getDefaultActiveTab(): string | int | null
    {
        return 'waiting';
    }

    /**
     * @return string|null
     */
    public function getActiveTab(): ?string
    {
        return $this->activeTab;
    }
    public function getTabs(): array
    {
        return [
            'Hepsi' => Tab::make(),
            'waiting' => Tab::make('Beklemedekiler')
                ->icon(StatusEnum::WAITING->getIcon())
                ->badgeColor('warning')
                ->badge(Request::query()->where('status', 'waiting')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'waiting')),
            'approved' => Tab::make('Onaylananlar')
                ->icon(StatusEnum::APPROVED->getIcon())
                ->badgeColor('success')
                ->badge(Request::query()->where('status', 'approved')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'approved')),
            'denied' => Tab::make('Reddedilenler')
                ->icon(StatusEnum::DENIED->getIcon())
                ->badgeColor('danger')
                ->badge(Request::query()->where('status', 'denied')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'denied')),
        ];
    }


}
