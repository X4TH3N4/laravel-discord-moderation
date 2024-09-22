<?php

namespace App\Filament\Admin\Resources;

use App\Enums\Channels\TypeEnum;
use App\Filament\Admin\Resources\GroupResource\Pages;
use App\Filament\Admin\Resources\GroupResource\RelationManagers;
use App\Models\Group;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Wallo\FilamentSelectify\Components\ButtonGroup;
use Wallo\FilamentSelectify\Components\ToggleButton;

class GroupResource extends Resource
{
    protected static ?string $model = Group::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    protected static ?string $navigationGroup = 'Sunucu İşlemleri';
    protected static ?string $modelLabel = 'Grup';
    protected static ?string $recordTitleAttribute = 'Grup';
    protected static ?string $pluralLabel = 'Gruplar';
    protected static ?int $navigationSort = -1;
        protected static bool $shouldRegisterNavigation = false;
    protected static ?string $activeNavigationIcon = 'heroicon-s-rectangle-group';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Grup Adı')
                        ->live()
                        ->icon('heroicon-s-rectangle-group')
                     ->description('Grup için bir ad belirleyin.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->default('Kategori Grubu')
                            ->required()
                            ->maxLength(255)
                            ->label('Grup Adı')
                            ->validationAttribute('Grup Adı'),
                    ]),
                    Step::make('Kategori Ekleme')
                        ->icon('heroicon-s-building-library')
                        ->description('Grup için kategorinizi oluşturun.')
                        ->schema([
                            Repeater::make('categories')
                                ->label('Kategoriler')
                                ->defaultItems(3)
                                ->orderColumn('position')
                                ->addActionLabel('Kategori Ekle')
                                ->reorderableWithButtons()
                                ->relationship('categories')
                                ->live()
                                ->columns(1)
                                ->schema([
                                    Select::make('guild_id')
                                        ->relationship('guild', 'name')
                                        ->label('Sunucu')
                                        ->validationAttribute('Sunucu')
                                        ->native(false)
                                        ->preload()
                                        ->default(1)
                                        ->live()
                                        ->required(),
                                    TextInput::make('name')
                                        ->label('Kategori Adı')
                                        ->validationAttribute('Kategori Adı')
                                        ->required()
                                        ->maxLength(255)
                                        ->default('Ana Kategori'),
                                    TextInput::make('position')
                                        ->label('Sırası')
                                        ->validationAttribute('Sırası')
                                        ->required()
                                        ->numeric()
                                        ->default(1)
                                        ->maxLength(255),
                                    Select::make('owners')
                                        ->relationship('owners', 'nick')
                                        ->label('Kategori Yöneticileri')
                                        ->validationAttribute('Kategori Yöneticileri')
                                        ->native(false)
                                        ->multiple()
                                        ->searchable()
                                        ->preload()
                                        ->default([2])
                                        ->live()
                                        ->required(),
                                    Select::make('members')
                                        ->relationship('members', 'nick')
                                        ->label('Kategori Üyeleri')
                                        ->validationAttribute('Kategori Üyeleri')
                                        ->native(false)
                                        ->multiple()
                                        ->searchable()
                                        ->preload()
                                        ->default([1,2])
                                        ->live()
                                        ->required(),

                                    Repeater::make('channels')
                                        ->relationship('channels')
                                        ->label('Kanallar')
                                        ->columns(2)
                                        ->defaultItems(5)
                                        ->orderColumn('position')
                                        ->addActionLabel('Kanal Ekle')
                                        ->reorderableWithButtons()
                                        ->schema([
                                            TextInput::make('name')
                                                ->label('Kanal Adı')
                                                ->validationAttribute('Kanal Adı')
                                                ->required()
                                                ->default('sohbet')
                                                ->maxLength(255),
                                            Select::make('guild_id')
                                                ->relationship('guild', 'name')
                                                ->label('Sunucu')
                                                ->validationAttribute('Sunucu')
                                                ->native(false)
                                                ->preload()
                                                ->default(1)
                                                ->live()
                                                ->required(),
                                            ButtonGroup::make('type')
                                                ->options([
                                                    TypeEnum::cases()
                                                ])
                                                ->label('Kanal Türü')
                                                ->validationAttribute('Kanal Türü')
                                                ->live()
                                                ->columnStart(1)
                                                ->onColor('primary')
                                                ->offColor('gray')
                                                ->reactive()
                                                ->afterStateUpdated(function ($state, callable $set) {
                                                    if ($state === '2') {
                                                        return $set('name', 'Sesli Kanal');
                                                    }
                                                    return $set('name', 'sohbet');
                                                }
                                                )
                                                ->default(0)
                                                ->options(TypeEnum::class),
                                            ToggleButton::make('nsfw')
                                                ->live()
                                                ->label('NSFW +18?')
                                                ->validationAttribute('NSFW')
                                                ->hidden(fn(Get $get): bool => $get('type'))
                                                ->onLabel('Evet')
                                                ->onColor('success')
                                                ->columnStart(2)
                                                ->offLabel('Hayır')
                                                ->offColor('danger')
                                                ->default(false),
                                            TextInput::make('bitrate')
                                                ->numeric()
                                                ->label('Kanal Bitrate')
                                                ->validationAttribute('Kanal Bitrate')
                                                ->requiredIf('type', 'GUILD_VOICE' || 'GUILD_STAGE_VOICE')
                                                ->helperText('Bu değer sunucunuzun desteklediği maksimum bitrate değerini gösterir.')
                                                ->minValue(8000)
                                                ->default(96000)
                                                ->suffix('bps')
                                                ->maxValue(384000)
                                                ->hidden(fn(Get $get): bool => !$get('type'))
                                                ->maxLength(255),
                                            TextInput::make('topic')
                                                ->maxLength(255)
                                                ->hidden(fn(Get $get): bool => $get('type'))
                                                ->default('Bu kanal, sunucudaki tüm kullanıcıların sohbet edebileceği bir kanaldır.')
                                                ->validationAttribute('Kanal Açıklaması')
                                                ->label('Kanal Açıklaması / Konusu'),
                                            TextInput::make('cooldown')
                                                ->numeric()
                                                ->label('Cooldown Süresi')
                                                ->validationAttribute('Cooldown Süresi')
                                                ->helperText('Min: 0, Max: 21600')
                                                ->minValue(0)
                                                ->default(0)
                                                ->maxValue(21600)
                                                ->hidden(fn(Get $get): bool => $get('type'))
                                                ->maxLength(255),
                                            TextInput::make('user_limit')
                                                ->numeric()
                                                ->hidden(fn(Get $get): bool => !$get('type'))
                                                ->label('Sesteki Kullanıcı Kapasitesi')
                                                ->placeholder('maksimum kullanıcı sayısı')
                                                ->helperText('Min: 0 Max:99')
                                                ->validationAttribute('Kullanıcı Kapasitesi')
                                                ->requiredIf('type', 'GUILD_VOICE' || 'GUILD_STAGE_VOICE')
                                                ->minValue(0)
                                                ->maxValue(99)
                                                ->default(0),
                                            TextInput::make('owner_id')
                                                ->label('Kanal Sahibi')
                                                ->hidden()
                                                ->validationAttribute('Kanal Sahibi')
                                                ->requiredIf('type', 'GUILD_VOICE' || 'GUILD_STAGE_VOICE')
                                                ->minValue(0),
//                                    TextInput::make('position')
//                                        ->label('Sıralama')
//                                        ->default(1)
//                                        ->validationAttribute('Sıralama')
//                                        ->numeric()
//                                        ->maxValue(50),

                                        ])


                                ]),
                                ]),
//                    Step::make('Rol')
//                        ->icon('heroicon-s-building-library')
//                        ->description('Kanala veya kategoriye rol ata.')
//                        ->live()
//                        ->columns(2)
//                        ->schema([
//
//                        ]),
                ])
                    ->submitAction(new HtmlString(Blade::render(
                            <<<BLADE
                        <x-filament::button type="submit" size="sm">Oluştur</x-filament::button>
                        BLADE
                        ))
                    )
                    ->columnSpanFull()
                    ->reactive()

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('categories.name')
                    ->searchable()->limit(50),
                Tables\Columns\TextColumn::make('channels.name')
                    ->searchable()->limit(50),
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\CategoriesRelationManager::make()
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGroups::route('/'),
            'create' => Pages\CreateGroup::route('/create'),
            'view' => Pages\ViewGroup::route('/{record}'),
            'edit' => Pages\EditGroup::route('/{record}/edit'),
        ];
    }
}
