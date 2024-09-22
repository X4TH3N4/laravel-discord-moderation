<?php

namespace App\Filament\Home\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Filament\Resources\MemberResource\RelationManagers;
use App\Models\Member;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Table;
use Wallo\FilamentSelectify\Components\ToggleButton;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationGroup = 'Discord İşlemleri';
    protected static ?string $modelLabel = 'Üye';

    protected static ?string $recordTitleAttribute = 'nick';

    protected static ?string $pluralLabel = 'Üyeler';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $activeNavigationIcon = 'heroicon-s-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Sunucu Üyesi')
                    ->description('Aşağıdaki bilgileri doldurarak bir sunucuy üyesi tanımlayın.')
                    ->columns(2)
                    ->schema(components: [
                        Forms\Components\TextInput::make('id')
                            ->numeric(),
                        Forms\Components\TextInput::make('nick')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('avatar')
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('joined_at'),
                        Forms\Components\DatePicker::make('premium_since'),
                        Forms\Components\Toggle::make('deaf')
                            ->label('Kulaklığı Kapalı Mı?'),
                        Forms\Components\Toggle::make('mute')
                            ->label('Susturulmuş Mu?'),
                        Forms\Components\Toggle::make('pending')
                            ->label('Kuralları Kabul Etmiş Mi?'),
                        ToggleButton::make('is_premium')
                            ->label('VIP mi?')
                            ->live()
                            ->validationAttribute('Üyelik Türü')
                            ->onColor('success')
                            ->offColor('danger')
                            ->onLabel('Evet')
                            ->offLabel('Hayır')
                            ->default(0),
                        ToggleButton::make('is_banned')
                            ->live()
                            ->label('Banlı Mı?')
                            ->validationAttribute('Banlı Mı?')
                            ->onLabel('Evet')
                            ->onColor('success')
                            ->offLabel('Hayır')
                            ->offColor('danger')
                            ->default(0),
                        ToggleButton::make('is_kicked')
                            ->live()
                            ->label('Kicklendi Mi?')
                            ->validationAttribute('Kicklendi Mi?')
                            ->onLabel('Evet')
                            ->onColor('success')
                            ->offLabel('Hayır')
                            ->offColor('danger')
                            ->default(0),
                        ToggleButton::make('is_in_timeout')
                            ->live()
                            ->label('Zamanaşımı Var Mı?')
                            ->validationAttribute('Zamanaşımı Var Mı?')
                            ->onLabel('Evet')
                            ->onColor('success')
                            ->offLabel('Hayır')
                            ->offColor('danger')
                            ->default(0),
                        Forms\Components\Select::make('roles')
                        ->relationship('roles','name')
                        ->preload()
                            ->multiple()
                        ->native(false)
                        ->live()
                        ->label('Labelc5')
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')

                    ->label('Kullanıcı ID')
                    ->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('nick')
                    ->label('Kullanıcı Adı')
                    ->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Rolleri')
                    ->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('avatar')
                    ->label('Avatar')
                    ->sortable()->searchable()->toggleable(),
                Tables\Columns\IconColumn::make('is_premium')
                    ->boolean()
                    ->label('VIP')
                    ->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('joined_at')
                    ->date()
                    ->label('Katılma Tarihi')
                    ->sortable()->searchable()->toggleable(),
//                Tables\Columns\TextColumn::make('premium_since')
//                    ->date()
//                    ->label('Boost Tarihi')
//                    ->sortable()->searchable()->toggleable(),
//                Tables\Columns\IconColumn::make('deaf')
//                    ->boolean()
//                    ->label('Kulaklığı kapalı mı?')
//                    ->sortable()->searchable()->toggleable(),
//                Tables\Columns\IconColumn::make('mute')
//                    ->boolean()
//                    ->label('Susturulu mu?')
//                   ->toggleable(),
//                Tables\Columns\IconColumn::make('is_banned')
//                    ->boolean()
//                    ->label('Yasaklı mı?')
//                   ->toggleable(),
//                Tables\Columns\IconColumn::make('is_kicked')
//                    ->boolean()
//                    ->label('Atıldı mı?')
//                   ->toggleable(),
//                Tables\Columns\IconColumn::make('is_in_timeout')
//                    ->boolean()
//                    ->label('Zamanaşımında mı?')
//                   ->toggleable(),
//                Tables\Columns\IconColumn::make('pending')
//                    ->label('Kuralları Onayladı mı?')
//                    ->boolean(),
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
                ])
                    ->label('İşlemler')
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
//                Tables\Actions\CreateAction::make(),
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
            'index' => \App\Filament\Home\Resources\MemberResource\Pages\ListMembers::route('/'),
            'create' => \App\Filament\Home\Resources\MemberResource\Pages\CreateMember::route('/create'),
            'view' => \App\Filament\Home\Resources\MemberResource\Pages\ViewMember::route('/{record}'),
            'edit' => \App\Filament\Home\Resources\MemberResource\Pages\EditMember::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
