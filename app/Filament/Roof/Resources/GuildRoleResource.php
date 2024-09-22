<?php

namespace App\Filament\Roof\Resources;

use App\Filament\Resources\GuildRoleResource\Pages;
use App\Filament\Resources\GuildRoleResource\RelationManagers;
use App\Filament\Roof\Resources\GuildRoleResource\RelationManagers\PermissionsRelationManager;
use App\Models\Color;
use App\Models\GuildRole;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Wallo\FilamentSelectify\Components\ToggleButton;

class GuildRoleResource extends Resource
{
    protected static ?string $model = GuildRole::class;

    protected static ?string $navigationGroup = 'Discord İşlemleri';
    protected static ?string $modelLabel = 'Rol';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $pluralLabel = 'Roller';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-shield-exclamation';
    protected static ?string $activeNavigationIcon = 'heroicon-s-shield-exclamation';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //          guild
                //        'mentionable',

                Forms\Components\Section::make('Roller')
                    ->description('Aşağıdaki bilgileri doldurarak bir rol oluşturun veya tanımlayın.')
                    ->columns(2)
                    ->schema(components: [
                        TextInput::make('id')
                            ->label('ID')
                            ->hidden()
                            ->maxLength(255),
                        TextInput::make('name')
                            ->label('Rol Adı')
                            ->validationAttribute('Rol Adı')
                            ->required()
                            ->maxLength(255),
                        Select::make('color_id')
                            ->label('Rol Rengi')
                            ->native(false)->searchable()
                            ->live()
                            ->preload()
                            ->relationship('color', 'name')
                            ->validationAttribute('Rol Rengi'),
                        ToggleButton::make('hoist')
                            ->label('Üye listesinde görüntülenebilir mi?')
                            ->live()
                            ->validationAttribute('Rol Görünümü')
                            ->onColor('success')
                            ->offColor('danger')
                            ->onLabel('Evet')
                            ->offLabel('Hayır'),
                        SpatieMediaLibraryFileUpload::make('icon')
                        ->live()
                        ->deletable()
                        ->appendFiles()
                        ->validationAttribute('Rol İkonu')
                        ->label('Rol İkonu')
                        ->collection('role_icons')
                        ->imageEditor()
                        ->image()
                        ->previewable()
                        ->openable()
                        ->downloadable(),
                        TextInput::make('unicode_emoji')
                            ->label('Rol Emojisi')
                            ->validationAttribute('Rol Emojisi')
                            ->helperText('Unicode emoji olması zorunludur.')
                            ->maxLength(255),
                        TextInput::make('position')
                            ->label('Rol Sırası')
                            ->numeric()
                            ->validationAttribute('Rol Sırası')
                            ->maxLength(255),
                        Select::make('permissions')
                            ->label('Yetkiler')
                            ->native(false)->searchable()
                            ->live()
                            ->multiple()
                            ->preload()
                            ->relationship('permissions', 'name')
                            ->validationAttribute('Yetkiler'),
                        ToggleButton::make('mentionable')
                            ->label('Rol etiketlenebilir mi?')
                            ->live()
                            ->validationAttribute('Rol Etiketlenebilirliği')
                            ->onColor('success')
                            ->offColor('danger')
                            ->onLabel('Evet')
                            ->offLabel('Hayır')
                            ->default(1),
//                        Forms\Components\Toggle::make('managed'),\Toggle::make('mentionable'),
//                        Forms\Components\Textarea::make('tags')
//                            ->columnSpanFull(),
//                        Forms\Components\TextInput::make('flags')
//                            ->numeric(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()->searchable()->toggleable(),
                TextColumn::make('name')
                    ->label('Rol Adı')
                    ->sortable()->searchable()->toggleable(),
                TextColumn::make('color.name')
                    ->numeric()
                    ->label('Rol Rengi')
                    ->sortable()->searchable()->toggleable(),
                SpatieMediaLibraryImageColumn::make('icon')
                ->collection('role_icons')
                ->label('İkon')
                ->circular(),
                IconColumn::make('hoist')
                    ->boolean(),
                TextColumn::make('unicode_emoji')
                    ->label('Emoji')
                    ->searchable(),
                TextColumn::make('position')
                    ->label('Sıra')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('permissions.name')
                    ->label('Yetkiler')
                    ->limit(20)
                    ->sortable()->searchable()->toggleable(),
//                Tables\Columns\IconColumn::make('managed')
//                    ->boolean(),
                IconColumn::make('mentionable')
                    ->boolean()
                    ->label('Etiketlenebilir Mi?')
                    ->toggleable(),
//                Tables\Columns\TextColumn::make('flags')
//                    ->numeric()
//                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
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
            ])->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            PermissionsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Roof\Resources\GuildRoleResource\Pages\ListGuildRoles::route('/'),
            'create' => \App\Filament\Roof\Resources\GuildRoleResource\Pages\CreateGuildRole::route('/create'),
            'view' => \App\Filament\Roof\Resources\GuildRoleResource\Pages\ViewGuildRole::route('/{record}'),
            'edit' => \App\Filament\Roof\Resources\GuildRoleResource\Pages\EditGuildRole::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
