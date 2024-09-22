<?php

namespace App\Filament\Roof\Resources;

use App\Enums\Channels\TypeEnum;
use App\Filament\Admin\Resources\RequestResource\Pages\CreateRequest;
use App\Filament\Resources\ChannelResource\Pages;
use App\Filament\Resources\ChannelResource\RelationManagers;
use App\Filament\Roof\Resources\ChannelResource\RelationManagers\CategoryRelationManager;
use App\Models\Channel;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Table;
use Wallo\FilamentSelectify\Components\ButtonGroup;
use Wallo\FilamentSelectify\Components\ToggleButton;

class ChannelResource extends Resource
{
    protected static ?string $model = Channel::class;

    protected static ?string $navigationGroup = 'Discord İşlemleri';
    protected static ?string $modelLabel = 'Kanal';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $pluralLabel = 'Kanallar';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $activeNavigationIcon = 'heroicon-s-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Kanal')
                    ->description('Aşağıdaki bilgileri doldurarak bir kanal oluşturun.')
                    ->columns(2)
                    ->schema(components: [
                        Select::make('category_id')
                            ->label('Kategori')
                            ->validationAttribute('Kategori')
                            ->live()
                            ->preload()
                            ->native(false)->searchable()
                            ->relationship('category','name')
                            ->editOptionForm([
                                Section::make('Kategori')
                                ->description('Aşağıdaki bilgileri doldurarak bir kategori oluşturun.')
                                ->columns(2)
                                ->schema(components: [
                                    Forms\Components\TextInput::make('name')
                                        ->label('Kategori Adı')
                                        ->validationAttribute('Kategori Adı')
                                        ->required()
                                        ->maxLength(255)
                                        ->default('general'),
                                    Forms\Components\Select::make('guild_id')
                                        ->validationAttribute('Sunucu')
                                        ->label('Sunucu')
                                        ->native(false)->searchable()
                                        ->live()
                                        ->default(1)
                                        ->preload()
                                        ->relationship('guild', 'name'),
                                    Forms\Components\Select::make('type')
                                        ->validationAttribute('Kategori Türü')
                                        ->label('Kategori Türü')
                                        ->native(false)->searchable()
                                        ->live()
                                        ->preload()
                                        ->required()
                                        ->hidden()
                                        ->options([4 => 'GUILD_CATEGORY'])
                                        ->default(4),
                                    Forms\Components\TextInput::make('position')
                                        ->label('Sıralama')
                                        ->validationAttribute('Sıralama')
                                        ->numeric()
                                        ->default(1)
                                        ->maxValue(50),
                                ])])
                            ->createOptionForm([
                                Section::make('Kategori')
                                ->description('Aşağıdaki bilgileri doldurarak bir kategori oluşturun.')
                                ->columns(2)
                                ->schema(components: [
                                    Forms\Components\TextInput::make('name')
                                        ->label('Kategori Adı')
                                        ->validationAttribute('Kategori Adı')
                                        ->required()
                                        ->maxLength(255)
                                        ->default('Ana Kategori'),
                                    Forms\Components\Select::make('guild_id')
                                        ->validationAttribute('Sunucu')
                                        ->label('Sunucu')
                                        ->native(false)->searchable()
                                        ->live()
                                        ->default(1)
                                        ->preload()
                                        ->relationship('guild', 'name'),
                                    Forms\Components\Select::make('type')
                                        ->validationAttribute('Kategori Türü')
                                        ->label('Kategori Türü')
                                        ->native(false)->searchable()
                                        ->live()
                                        ->preload()
                                        ->required()
                                        ->hidden()
                                        ->options([4 => 'GUILD_CATEGORY'])
                                        ->default(4),
                                    Forms\Components\TextInput::make('position')
                                        ->label('Sıralama')
                                        ->validationAttribute('Sıralama')
                                        ->numeric()
                                        ->maxValue(50),
                                ])]),
                        TextInput::make('name')
                            ->label('Kanal Adı')
                            ->validationAttribute('Kanal Adı')
                            ->required()
                            ->default('sohbet')
                            ->maxLength(255),
                        Select::make('guild_id')
                            ->relationship('guild', 'name')
                            ->label('Sunucu')
                            ->reactive()
                            ->validationAttribute('Sunucu')
                            ->live()
                            ->default(1)
                            ->preload()
                            ->native(false),
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
                                    CreateRequest::setCanCreateAnother(false);
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
                            ->disabled()
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
                            ->numeric()
                            ->label('Kanal Sahibi')
                            ->hidden()
                            ->validationAttribute('Kanal Sahibi')
                            ->requiredIf('type', 'GUILD_VOICE' || 'GUILD_STAGE_VOICE')
                            ->minValue(0),
                        TextInput::make('position')
                            ->label('Sıralama')
                            ->validationAttribute('Sıralama')
                            ->numeric()
                            ->maxValue(50),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Kanal Adı')
                    ->sortable()->searchable()->toggleable(),
                    Tables\Columns\TextColumn::make('guild.name')
                    ->label('Sunucu Adı')
                    ->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori Adı')
                    ->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Kanal Türü')
                    ->sortable()->searchable()->toggleable(),
//                Tables\Columns\TextColumn::make('topic')
//                    ->label('Kanal Konusu')
//                    ->sortable()->searchable()->toggleable(),
//                Tables\Columns\TextColumn::make('nsfw')
//                    ->label('NSFW')
//                    ->sortable()->searchable()->toggleable(),
//                Tables\Columns\TextColumn::make('bitrate')
//                    ->label('Kanal Bitrate')
//                    ->sortable()->searchable()->toggleable(),
//                Tables\Columns\TextColumn::make('user_limit')
//                    ->label('Üye Sınırı')
//                    ->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('owner.name')
                    ->label('Kanal Sahibi')
                    ->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('position')
                    ->label('Kanal Sıralaması')
                    ->sortable()->searchable()->toggleable(),

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
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])->defaultSort('created_at', 'asc');
    }

    public static function getRelations(): array
    {
        return [
           CategoryRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Roof\Resources\ChannelResource\Pages\ListChannels::route('/'),
            'create' => \App\Filament\Roof\Resources\ChannelResource\Pages\CreateChannel::route('/create'),
            'view' => \App\Filament\Roof\Resources\ChannelResource\Pages\ViewChannel::route('/{record}'),
            'edit' => \App\Filament\Roof\Resources\ChannelResource\Pages\EditChannel::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
