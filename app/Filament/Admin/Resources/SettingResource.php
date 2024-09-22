<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SettingResource\Pages;
use App\Filament\Admin\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Wallo\FilamentSelectify\Components\ToggleButton;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;
    protected static ?string $navigationGroup = 'Bot İşlemleri';
    protected static ?string $modelLabel = 'Bot Ayarları';
protected static bool $shouldRegisterNavigation = false;
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $pluralLabel = 'BOT Ayarları';
    protected static ?int $navigationSort = -2;
    protected static ?string $navigationIcon = 'heroicon-o-queue-list';
    protected static ?string $activeNavigationIcon = 'heroicon-s-queue-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Sunucu Ayarları')
                    ->live()
                    ->description('Aşağıdan sunucu ayarlarınızı güncelleyebilirsiniz.')
                    ->columns(4)
                    ->schema([
                        Select::make('guild_id')
                            ->validationAttribute('Sunucu')
                            ->label('Sunucu')
                            ->relationship('guild', 'name')
                            ->native(false)
                            ->live()
                            ->columnStart(2)
                            ->columnSpan(2)
                            ->default(1)
                            ->preload()
                            ->required(),
                        ToggleButton::make('public1')
                            ->reactive()
                            ->label('Reklam yapılsın mı?')
                            ->onLabel('Evet')
                            ->offLabel('Hayır')
                            ->default(1)
                            ->columnStart(1)
                            ->validationAttribute('Mesaj Log Kanal ID'),
                        ToggleButton::make('public2')
                            ->reactive()
                            ->label('Sunucu daveti atılsın mı?')
                            ->onLabel('Evet')
                            ->default(1)
                            ->columnStart(2)
                            ->offLabel('Hayır')
                            ->validationAttribute('Mesaj Log Kanal ID'),
                        ToggleButton::make('private')
                            ->reactive()
                            ->label('Abonelik kontrol sistemi açılsın mı?')
                            ->onLabel('Evet')
                            ->default(1)
                            ->columnStart(3)
                            ->offLabel('Hayır')
                            ->validationAttribute('Mesaj Log Kanal ID'),
                        ToggleButton::make('private2')
                            ->reactive()
                            ->label('Boost kontrol sistemi açılsın mı?')
                            ->onLabel('Evet')
                            ->default(1)
                            ->columnStart(4)
                            ->offLabel('Hayır')
                            ->validationAttribute('Mesaj Log Kanal ID')
                    ]),
                Section::make('Kanal')
                    ->live()
                    ->description('Aşağıdan kanal bilgilerini güncelleyebilirsiniz.')
                    ->columns(3)
                    ->schema([
                        TextInput::make('message_channel_id')
                            ->reactive()
                            ->label('Mesaj Log Kanal ID')
                            ->helperText('İlgili kanala sağ tıklayarak ID bilgisini görebilirsin.')
                            ->validationAttribute('Mesaj Log Kanal ID')
                            ->default('1155264147005657148'),
                        TextInput::make('bot_ready_channel_id')
                            ->reactive()
                            ->label('Bot Hazır Kanal ID')
                            ->helperText('İlgili kanala sağ tıklayarak ID bilgisini görebilirsin.')
                            ->validationAttribute('Bot Hazır Kanal ID')
                            ->default('1155264790428655616'),
                        TextInput::make('login_logout_channel_id')
                            ->reactive()
                            ->label('Giriş Çıkış Log Kanal ID')
                            ->helperText('İlgili kanala sağ tıklayarak ID bilgisini görebilirsin.')
                            ->validationAttribute('Giriş Çıkış Log Kanal ID')
                            ->default('1155264562912829440'),
                        TextInput::make('role_channel_id')
                            ->reactive()
                            ->label('Rol Log Kanal ID')
                            ->helperText('İlgili kanala sağ tıklayarak ID bilgisini görebilirsin.')
                            ->validationAttribute('Rol Log Kanal ID')
                            ->default('1155265554043642018'),
                        TextInput::make('voice_activity_channel_id')
                            ->reactive()
                            ->label('Ses Log Kanal ID')
                            ->helperText('İlgili kanala sağ tıklayarak ID bilgisini görebilirsin.')
                            ->validationAttribute('Ses Log Kanal ID')
                            ->default('1155265624814141480'),
                        TextInput::make('ban_channel_id')
                            ->reactive()
                            ->label('Ban Log Kanal ID')
                            ->helperText('İlgili kanala sağ tıklayarak ID bilgisini görebilirsin.')
                            ->validationAttribute('Ban Log Kanal ID')
                            ->default('1155265698940076113'),
                        TextInput::make('kick_channel_id')
                            ->reactive()
                            ->label('Kick Log Kanal ID')
                            ->helperText('İlgili kanala sağ tıklayarak ID bilgisini görebilirsin.')
                            ->validationAttribute('Kick Log Kanal ID')
                            ->default('1155265783077810176'),
                        TextInput::make('timeout_channel_id')
                            ->reactive()
                            ->label('Timeout Log Kanal ID')
                            ->helperText('İlgili kanala sağ tıklayarak ID bilgisini görebilirsin.')
                            ->validationAttribute('Timeout Log Kanal ID')
                            ->default('1155265860886331496'),
                        TextInput::make('mute_channel_id')
                            ->reactive()
                            ->label('Mute Log Kanal ID')
                            ->helperText('İlgili kanala sağ tıklayarak ID bilgisini görebilirsin.')
                            ->validationAttribute('Mute Log Kanal ID')
                            ->default('1155265958529740962'),
                        TextInput::make('announcement_channel_id')
                            ->reactive()
                            ->label('Duyuru Kanal ID')
                            ->helperText('İlgili kanala sağ tıklayarak ID bilgisini görebilirsin.')
                            ->validationAttribute('Duyuru Kanal ID')
                            ->default('1148179348524900364'),
                        TextInput::make('rule_channel_id')
                            ->reactive()
                            ->label('Kurallar Kanal ID')
                            ->columnStart(3)
                            ->helperText('İlgili kanala sağ tıklayarak ID bilgisini görebilirsin.')
                            ->validationAttribute('Kurallar Kanal ID')
                            ->default('1148179348524900364')
                    ]),
                Section::make('Rol')
                    ->live()
                    ->columns(4)
                    ->description('Aşağıdan rol bilgilerini güncelleyebilirsiniz.')
                    ->schema([
                        Select::make('bots_role_id')
                            ->label('Bot Rol')
                            ->preload()
                            ->live()
                            ->native(false)
                            ->default('1154101747699155044')
                            ->options([
                                '1154101747699155044' => 'BOT',
                            ])
                            ->validationAttribute('Bot Rol ID'),
                        Select::make('members_role_id')
                            ->label('Üye Rol')
                            ->default('1154101726345969684')
                            ->preload()
                            ->live()
                            ->native(false)
                            ->options([
                                '1154101726345969684' => 'User',
                            ]),
                        Select::make('unregistered_role_id')
                            ->label('Kayıtsız Rol')
                            ->preload()
                            ->live()
                            ->default('1154101726345969684')
                            ->native(false)
                            ->options([
                                '1154101726345969684' => 'Kayıtsız',
                            ]),
                        Select::make('vip_role_id')
                            ->label('VIP Rol')
                            ->preload()
                            ->live()
                            ->default('1155224304259182853')
                            ->native(false)
                            ->options([
                                '1155224304259182853' => 'VIP',
                            ]),
                    ]),
                Section::make('Bot')
                    ->live()
                    ->columns(2)
                    ->description('Aşağıdan bot bilgilerini güncelleyebilirsiniz.')
                    ->schema([
                        TextInput::make('token')
                            ->label('Token')
                            ->password()
                            ->default('8368435786894578967894589679879')
                            ->maxLength(255)
                            ->validationAttribute('Bot Tokeni'),
                        TextInput::make('bot_id')
                            ->label('ID')
                            ->default('1151498918572589148')
                            ->maxLength(255)
                            ->validationAttribute('Bot ID'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('guild.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('public_guild_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('message_channel_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('login_logout_channel_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bot_ready_channel_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('role_channel_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('voice_activity_channel_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ban_channel_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kick_channel_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('timeout_channel_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mute_channel_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('announcement_channel_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rule_channel_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('log_category_channel_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('management_category_channel_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('members_role_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bots_role_id')
                    ->searchable(),
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
//                Tables\Actions\ViewAction::make(),
//                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
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
            'index' => Pages\ListSettings::route('/'),
//            'create' => Pages\CreateSetting::route('/create'),
//            'view' => Pages\ViewSetting::route('/{record}'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
