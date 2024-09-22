<?php

namespace App\Filament\Roof\Resources;

use App\Filament\Resources\GuildResource\Pages;
use App\Filament\Resources\GuildResource\RelationManagers;
use App\Models\Guild;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Table;

class GuildResource extends Resource
{
    protected static ?string $model = Guild::class;
    protected static ?string $navigationGroup = 'Discord İşlemleri';
    protected static ?string $modelLabel = 'Sunucu';

    protected static ?string $recordTitleAttribute = 'name';
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $pluralLabel = 'Sunucular';
    protected static ?int $navigationSort = -1;
    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    protected static ?string $activeNavigationIcon = 'heroicon-m-building-library';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Sunucu')
                    ->description('Aşağıdaki bilgileri girerek bir sunucu oluşturun veya tanımlayın.')
                    ->columns(2)
                    ->schema(components: [
                        Forms\Components\TextInput::make('name')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('description')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('icon')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('icon_hash')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('splash')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('discovery_splash')
                            ->maxLength(255),
                        Forms\Components\Toggle::make('owner'),
                        Forms\Components\TextInput::make('owner_id')
                            ->numeric(),
                        Forms\Components\TextInput::make('region')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('afk_channel_id')
                            ->numeric(),
                        Forms\Components\TextInput::make('afk_timeout')
                            ->numeric(),
                        Forms\Components\Toggle::make('widget_enabled'),
                        Forms\Components\TextInput::make('widget_channel_id')
                            ->numeric(),
                        Forms\Components\TextInput::make('verification_level')
                            ->numeric(),
                        Forms\Components\TextInput::make('default_message_notifications')
                            ->numeric(),
                        Forms\Components\TextInput::make('explicit_content_filter')
                            ->numeric(),
                        Forms\Components\Textarea::make('roles')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('emojis')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('features')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('mfa_level')
                            ->numeric(),
                        Forms\Components\TextInput::make('application_id')
                            ->numeric(),
                        Forms\Components\TextInput::make('system_channel_id')
                            ->numeric(),
                        Forms\Components\TextInput::make('system_channel_flags')
                            ->numeric(),
                        Forms\Components\TextInput::make('rules_channel_id')
                            ->numeric(),
                        Forms\Components\TextInput::make('max_presences')
                            ->numeric(),
                        Forms\Components\TextInput::make('max_members')
                            ->numeric(),
                        Forms\Components\TextInput::make('vanity_url_code')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('banner')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('premium_tier')
                            ->numeric(),
                        Forms\Components\TextInput::make('premium_subscription_count')
                            ->numeric(),
                        Forms\Components\TextInput::make('preferred_locale')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('public_updates_channel_id')
                            ->numeric(),
                        Forms\Components\TextInput::make('max_video_channel_users')
                            ->numeric(),
                        Forms\Components\TextInput::make('max_stage_video_Channel_users')
                            ->numeric(),
                        Forms\Components\TextInput::make('approximate_member_count')
                            ->numeric(),
                        Forms\Components\TextInput::make('approximate_presence_count')
                            ->numeric(),
                        Forms\Components\Textarea::make('welcome_screen')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('nsfw_level')
                            ->numeric(),
                        Forms\Components\Textarea::make('stickers')
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('premium_progress_bar_enabled'),
                        Forms\Components\TextInput::make('safety_alerts_channel_id')
                            ->numeric(),

                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('icon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('icon_hash')
                    ->searchable(),
                Tables\Columns\TextColumn::make('splash')
                    ->searchable(),
                Tables\Columns\TextColumn::make('discovery_splash')
                    ->searchable(),
                Tables\Columns\IconColumn::make('owner')
                    ->boolean(),
                Tables\Columns\TextColumn::make('owner_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('region')
                    ->searchable(),
                Tables\Columns\TextColumn::make('afk_channel_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('afk_timeout')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('widget_enabled')
                    ->boolean(),
                Tables\Columns\TextColumn::make('widget_channel_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('verification_level')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('default_message_notifications')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('explicit_content_filter')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mfa_level')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('application_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('system_channel_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('system_channel_flags')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('rules_channel_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('max_presences')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('max_members')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vanity_url_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('banner')
                    ->searchable(),
                Tables\Columns\TextColumn::make('premium_tier')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('premium_subscription_count')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('preferred_locale')
                    ->searchable(),
                Tables\Columns\TextColumn::make('public_updates_channel_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('max_video_channel_users')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('max_stage_video_Channel_users')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('approximate_member_count')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('approximate_presence_count')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nsfw_level')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('premium_progress_bar_enabled')
                    ->boolean(),
                Tables\Columns\TextColumn::make('safety_alerts_channel_id')
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
            'index' => \App\Filament\Roof\Resources\GuildResource\Pages\ListGuilds::route('/'),
            'create' => \App\Filament\Roof\Resources\GuildResource\Pages\CreateGuild::route('/create'),
            'view' => \App\Filament\Roof\Resources\GuildResource\Pages\ViewGuild::route('/{record}'),
            'edit' => \App\Filament\Roof\Resources\GuildResource\Pages\EditGuild::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
