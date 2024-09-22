<?php

namespace App\Filament\Admin\Resources;

use App\Enums\Request\StatusEnum;
use App\Enums\Request\TypeEnum;
use App\Filament\Admin\Resources\RequestResource\Pages;
use App\Filament\Admin\Resources\RequestResource\RelationManagers;
use App\Models\Request;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class RequestResource extends Resource
{
    protected static ?string $model = Request::class;
    protected static ?string $navigationGroup = 'Sunucu İşlemleri';
    protected static ?string $modelLabel = 'İşlem';
    protected static ?string $recordTitleAttribute = 'İşlem';
    protected static ?string $pluralLabel = 'İşlemler';
    protected static ?int $navigationSort = -2;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $activeNavigationIcon = 'heroicon-s-rectangle-stack';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('İşlem')
                    ->description('Aşağıdaki bilgileri doldurarak işlem oluşturabilirsiniz.')
                    ->columns(2)
                    ->live()
                    ->schema(components: [
                        Select::make('object_id')
                            ->label('Kişi')
                            ->validationAttribute('Kişi')
                            ->relationship('object', 'nick')
                            ->preload()
                            ->live()
                            ->native(false)
                            ->required(),
                        Select::make('type')
                            ->label('İşlem Türü')
                            ->validationAttribute('İşlem Türü')
                            ->required()
                            ->preload()
                            ->live()
                            ->native(false)
                            ->options(TypeEnum::class),
                        Forms\Components\Textarea::make('reason')
                            ->label('Sebep')
                            ->columnSpanFull()
                            ->placeholder(Auth::user()->name. ' tarafından istendi.')
                            ->validationAttribute('Sebep')
                            ->maxLength(255),
                        Select::make('status')
                            ->label('İstek Durumu')
                            ->validationAttribute('İstek Durumu')
                            ->options(StatusEnum::class)
//                    ->default('waiting')
                            ->hiddenOn(['create'])
                            ->native(false)
                            ->preload()
                            ->live()])


            ]);
    }

    public static function table(Table $table): Table
    {
        if (User::isAdmin()) {
            return $table
                ->columns([
                    Tables\Columns\TextColumn::make('object.nick')
                        ->label('Üye')
                        ->searchable()
                        ->toggleable()
                        ->sortable(),
                    Tables\Columns\TextColumn::make('admin.name')
                        ->label('Yetkili')
                        ->searchable()
                        ->toggleable()
                        ->sortable(),
                    Tables\Columns\TextColumn::make('author.name')
                        ->label('İşlem Sahibi')
                        ->searchable()
                        ->toggleable()
                        ->sortable(),
                    Tables\Columns\TextColumn::make('type')
                        ->label('İşlem Türü')
                        ->badge()
                        ->toggleable()
                        ->sortable()
                        ->searchable(),
                    Tables\Columns\TextColumn::make('reason')
                        ->label('Sebep')
                        ->limit(25)
                        ->searchable(),
                    Tables\Columns\TextColumn::make('status')
                        ->label('Durum')
                        ->badge()
                        ->toggleable()
                        ->sortable()
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
                    ActionGroup::make([
                        Action::make('approve')
                            ->action(function (Request $record): void {
                                $record->status = StatusEnum::APPROVED;
                                $record->save();

                            })
                            ->label('Onayla')
                            ->icon('heroicon-m-check-circle')
                            ->color('success'),
                        Action::make('deny')
                            ->action(function (Request $record): void {
                                $record->status = StatusEnum::DENIED;
                                $record->save();
                            })
                            ->label('Reddet')
                            ->icon('heroicon-m-x-mark')
                            ->color('danger'),
                        DeleteAction::make()
                            ->color('warning'),
                    ])
                        ->color('primary')
                        ->icon('heroicon-s-pencil-square')
                        ->size(ActionSize::Small)
                        ->button()
                        ->label('Düzenle')
                ])
                ->bulkActions([
                    Tables\Actions\BulkActionGroup::make([
                        Tables\Actions\DeleteBulkAction::make(),
                    ]),
                ])->defaultSort('created_at', 'desc');
        }

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('object.nick')
                    ->label('Üye')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('admin.name')
                    ->label('Yetkili')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('author.name')
                    ->label('İşlem Sahibi')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('İşlem Türü')
                    ->badge()
                    ->toggleable()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('reason')
                    ->label('Sebep')
                    ->limit(25)
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Durum')
                    ->badge()
                    ->toggleable()
                    ->sortable()
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
//                ViewAction::make()->color('primary'),
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
//        if (!User::isAdmin())
//        {
//            return [
//                'index' => Pages\ListRequests::route('/'),
//                'create' => Pages\CreateRequest::route('/create'),
//            ];
//        }

        return [
            'index' => Pages\ListRequests::route('/'),
            'create' => Pages\CreateRequest::route('/create'),
            'view' => Pages\ViewRequest::route('/{record}'),
            'edit' => Pages\EditRequest::route('/{record}/edit'),
        ];
    }
}
