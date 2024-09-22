<?php

namespace App\Filament\Home\Resources;

use App\Enums\Channels\TypeEnum;
use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Filament\Home\Resources\CategoryResource\RelationManagers\ChannelsRelationManager;
use App\Models\Category;
use App\Models\Channel;
use App\Models\Guild;
use App\Models\User;
use Closure;
use Faker\Core\Number;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Psy\Util\Str;
use Ramsey\Uuid\Type\Integer;
use Wallo\FilamentSelectify\Components\ButtonGroup;
use Wallo\FilamentSelectify\Components\ToggleButton;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationGroup = 'Discord İşlemleri';
    protected static ?string $modelLabel = 'Kategori';

    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $pluralLabel = 'Kategoriler';
    protected static ?int $navigationSort = -2;
    protected static ?string $navigationIcon = 'heroicon-o-queue-list';
    protected static ?string $activeNavigationIcon = 'heroicon-s-queue-list';

    /**
     * @throws \Exception
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Ana Bilgiler')
                        ->icon('heroicon-s-building-library')
                        ->description('Ana bilgileri girerek başla.')
                        ->live()
                        ->columns(2)
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
                        ]),
                    Step::make('Kanal')
                        ->icon('heroicon-s-squares-plus')
                        ->description('Kategorine kanallar ekle.')
                        ->live()
                        ->columns(1)
                        ->schema([
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
//                                    Select::make('guild_id')
//                                        ->relationship('guild', 'name')
//                                        ->label('Sunucu')
//                                        ->validationAttribute('Sunucu')
//                                        ->native(false)
//                                        ->preload()
//                                        ->default(1)
//                                        ->live()
//                                        ->required(),
                                    ButtonGroup::make('type')
                                        ->options([
                                            TypeEnum::cases()
                                        ])
                                        ->label('Kanal Türü')
                                        ->validationAttribute('Kanal Türü')
                                        ->live(onBlur: true)
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
                    ->label('Kategori Adı')
                    ->searchable()->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('guild.name')
                    ->label('Sunucu')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('owners.nick')
                    ->label('Yöneticiler')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Kategori Türü')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('position')
                    ->label('Kategori Sırası')
                    ->numeric()
                    ->sortable(),
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
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ForceDeleteAction::make()])->label('İşlemler')
                    ->color('info')
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->size(ActionSize::Small)
                    ->button(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])->reorderable('position')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])->defaultSort('position', 'asc');
    }

    public static function getRelations(): array
    {
        return [
            ChannelsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Home\Resources\CategoryResource\Pages\ListCategories::route('/'),
            'create' => \App\Filament\Home\Resources\CategoryResource\Pages\CreateCategory::route('/create'),
            'view' => \App\Filament\Home\Resources\CategoryResource\Pages\ViewCategory::route('/{record}'),
            'edit' => \App\Filament\Home\Resources\CategoryResource\Pages\EditCategory::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
