<?php

namespace App\Filament\Roof\Resources\CategoryResource\RelationManagers;

use App\Enums\Channels\TypeEnum;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Wallo\FilamentSelectify\Components\ButtonGroup;
use Wallo\FilamentSelectify\Components\ToggleButton;

class ChannelsRelationManager extends RelationManager
{
    protected static string $relationship = 'channels';

    public function form(Form $form): Form
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Kanal Adı')
                    ->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Kanal Türü')
                    ->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('guild_id')
                    ->label('Sunucu Adı')
                    ->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('topic')
                    ->label('Kanal Konusu')
                    ->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('nsfw')
                    ->label('NSFW')
                    ->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('bitrate')
                    ->label('Kanal Bitrate')
                    ->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('user_limit')
                    ->label('Üye Sınırı')
                    ->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('owner_id')
                    ->label('Kanal Sahibi')
                    ->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('position')
                    ->label('Kanal Sıralaması')
                    ->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('category_id')
                    ->label('Kategori Adı')
                    ->sortable()->searchable()->toggleable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
