<?php

namespace App\Filament\Admin\Resources;

use App\Enums\Channels\TypeEnum;
use App\Filament\Admin\Resources\MessageResource\Pages;
use App\Filament\Admin\Resources\MessageResource\RelationManagers;
use App\Models\Message;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Wallo\FilamentSelectify\Components\ButtonGroup;
use Wallo\FilamentSelectify\Components\ToggleButton;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;
//    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $navigationGroup = 'Sunucu İşlemleri';
    protected static ?string $modelLabel = 'Mesaj';
    protected static ?string $recordTitleAttribute = 'Mesaj';
    protected static ?string $pluralLabel = 'Mesajlar';
    protected static ?int $navigationSort = -1;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-arrow-down';
    protected static ?string $activeNavigationIcon = 'heroicon-s-inbox-arrow-down';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    //        'content',
    //        'user_id', //MESSAGE OWNER
    //        'guild_id',
    //        'channel_id',

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Mesaj')
                    ->description('Bir kanala mesaj gönderir')
                    ->columns(2)
                    ->live()
                    ->schema([
                        Forms\Components\Select::make('guild_id')
                            ->relationship('guild', 'name')
                            ->native(false)
                            ->preload()
                            ->required()
                            ->default(1)
                            ->live()
                            ->validationAttribute('Sunucu')
                            ->label('Sunucu'),
                        Forms\Components\Select::make('channel_id')
                            ->native(false)
                            ->preload()
                            ->required()
                            ->live()
                            ->createOptionForm([
                                Section::make('Kanal')
                                    ->description('Aşağıdaki bilgileri doldurarak bir kanal oluşturun.')
                                    ->columns(2)
                                    ->schema(components: [
                                        Select::make('category_id')
                                            ->label('Kategori')
                                            ->validationAttribute('Kategori')
                                            ->live()
                                            ->preload()
                                            ->native(false)
                                            ->searchable()
                                            ->relationship('category', 'name')
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
                                                            ->hidden()
                                                            ->native(false)->searchable()
                                                            ->live()
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
                                                            ->options(['GUILD_CATEGORY' => 'GUILD_CATEGORY'])
                                                            ->default('GUILD_CATEGORY'),
                                                        Forms\Components\TextInput::make('position')
                                                            ->label('Sıralama')
                                                            ->validationAttribute('Sıralama')
                                                            ->numeric()
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
                                                            ->hidden()
                                                            ->native(false)->searchable()
                                                            ->live()
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
                                                            ->options(['GUILD_CATEGORY' => 'GUILD_CATEGORY'])
                                                            ->default('GUILD_CATEGORY'),
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
                                                    return $set('name', 'Sesli Kanal');
                                                }
                                                return $set('name', 'sohbet');
                                            }
                                            )
                                            ->default(0)
                                            ->options(TypeEnum::cases()),
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

                            ])
                            ->validationAttribute('Kanal')
                            ->label('Kanal')
                            ->relationship('channel', 'name'),
                        Forms\Components\Textarea::make('content')
                            ->columnSpanFull()
                            ->autosize()
                            ->label('Mesaj İçeriği')
                            ->validationAttribute('Mesaj İçeriği')
                            ->maxLength(2000)
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('guild.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('channel.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('color.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('content')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_pinnable')
                    ->boolean(),
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
            ])->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListMessages::route('/'),
            'create' => Pages\CreateMessage::route('/create'),
            'view' => Pages\ViewMessage::route('/{record}'),
            'edit' => Pages\EditMessage::route('/{record}/edit'),
        ];
    }
}
