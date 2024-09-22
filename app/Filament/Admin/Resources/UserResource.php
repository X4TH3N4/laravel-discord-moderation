<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Wallo\FilamentSelectify\Components\ToggleButton;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'Yetkili İşlemleri';
    protected static ?string $modelLabel = 'Kullanıcı';

    protected static ?string $recordTitleAttribute = 'username';

    protected static ?string $pluralLabel = 'Kullanıcılar';
    protected static ?int $navigationSort = -1;
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $activeNavigationIcon = 'heroicon-s-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(components: [
                Forms\Components\Section::make('Kullanıcı')
                    ->description('Aşağıda kullanıcı bilgilerini görüntüleyebilir veya değiştirebilirsiniz.')
                    ->columns(3)
                    ->schema(components: [
                        Forms\Components\TextInput::make('name')
                            ->label('Ad')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('username')
                            ->label('Kullanıcı Adı')
                            ->required()
                            ->maxLength(255)
                            ->disabledOn(['create', 'edit'])
                            ->hiddenOn(['create']),
                        Forms\Components\TextInput::make('global_name')
                            ->label('Görünen Ad')
                            ->maxLength(255)
                            ->disabledOn(['create', 'edit'])
                            ->hiddenOn(['create']),
                        Forms\Components\TextInput::make('email')
                            ->label('E-posta Adresi')
                            ->email()
                            ->maxLength(255)
                            ->disabledOn(['edit']),
                        Forms\Components\TextInput::make('locale')
                            ->label('Dil')
                            ->required()
                            ->maxLength(255)
                            ->disabledOn(['create', 'edit'])
                            ->hiddenOn(['create']),
                        Select::make('roles')
                            ->label('Rolü')
                            ->multiple()
                            ->required()
                            ->relationship('roles', 'name')
                            ->label('Roller')
                            ->native(false)->searchable()
                            ->live()
                            ->preload(),
                        ToggleButton::make('is_premium')
                            ->label('VIP mi?')
                            ->live()
                            ->validationAttribute('Üyelik Türü')
                            ->onColor('success')
                            ->offColor('danger')
                            ->onLabel('Evet')
                            ->offLabel('Hayır')
                            ->default(1),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable()
                    ->toggleable()
                    ->searchable()
                    ->label('ID'),
                Tables\Columns\SpatieMediaLibraryImageColumn::make('avatars')
                    ->label('Avatar')
                    ->collection('avatars')->circular(),
                Tables\Columns\TextColumn::make('username')
                    ->sortable()
                    ->toggleable()
                    ->searchable()
                    ->label('Kullanıcı Adı'),
                Tables\Columns\TextColumn::make('global_name')
                    ->sortable()
                    ->toggleable()
                    ->searchable()
                    ->label('Görünen Adı'),
                Tables\Columns\IconColumn::make('is_premium')
                    ->boolean()
                    ->label('VIP')
                    ->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('roles.name')
                    ->searchable()->sortable()->label('Roller')->color('primary'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                ])
                    ->label('İşlemler')
                    ->color('info')
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->size(ActionSize::Small)
                    ->button(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Admin\Resources\UserResource\Pages\ListUsers::route('/'),
            'create' => \App\Filament\Admin\Resources\UserResource\Pages\CreateUser::route('/create'),
            'view' => \App\Filament\Admin\Resources\UserResource\Pages\ViewUser::route('/{record}'),
            'edit' => \App\Filament\Admin\Resources\UserResource\Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

}
