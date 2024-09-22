<?php

namespace App\Filament\Roof\Resources;

use App\Filament\Resources\GuildPermissionResource\Pages;
use App\Filament\Resources\GuildPermissionResource\RelationManagers;
use App\Models\GuildPermission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Table;

class GuildPermissionResource extends Resource
{
    protected static ?string $model = GuildPermission::class;

    protected static ?string $navigationGroup = 'Discord İşlemleri';
    protected static ?string $modelLabel = 'Yetki';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $pluralLabel = 'Yetkiler';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $activeNavigationIcon = 'heroicon-s-shield-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Yetki')
                    ->description('Aşağıdaki bilgileri doldurarak bir yetki oluşturun.')
                    ->columns(2)
                    ->schema(components: [
                        Forms\Components\TextInput::make('name')
                            ->label('Yetki Adı')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('key')
                            ->label('Yetki Değeri')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('description')
                            ->label('Yetki Açıklaması')
                            ->maxLength(255),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Yetki Adı')
                    ->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('key')
                    ->label('Yetki Değeri')
                    ->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Açıklama')
                    ->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
//                    Tables\Actions\EditAction::make(),
//                    Tables\Actions\DeleteAction::make(),
//                    Tables\Actions\ForceDeleteAction::make()
                ])->label('İşlemler')
                    ->color('info')
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->size(ActionSize::Small)
                    ->button(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Roof\Resources\GuildPermissionResource\Pages\ListGuildPermissions::route('/'),
            'create' => \App\Filament\Roof\Resources\GuildPermissionResource\Pages\CreateGuildPermission::route('/create'),
            'view' => \App\Filament\Roof\Resources\GuildPermissionResource\Pages\ViewGuildPermission::route('/{record}'),
            'edit' => \App\Filament\Roof\Resources\GuildPermissionResource\Pages\EditGuildPermission::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
