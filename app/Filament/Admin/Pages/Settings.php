<?php
//
//namespace App\Filament\Admin\Pages;
//
//use App\Models\Bot;
//use App\Models\GuildRole;
//use Closure;
//use Filament\Actions\Action;
//use Filament\Actions\ActionGroup;
//use Filament\Actions\Concerns\InteractsWithActions;
//use Filament\Actions\Contracts\HasActions;
//use Filament\Forms\Components\Card;
//use Filament\Forms\Components\Contracts\HasFileAttachments;
//use Filament\Forms\Components\Fieldset;
//use Filament\Forms\Components\Grid;
//use Filament\Forms\Components\Section;
//use Filament\Forms\Components\Select;
//use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
//use Filament\Forms\Components\TextInput;
//use Filament\Forms\Concerns\InteractsWithForms;
//use Filament\Forms\Contracts\HasForms;
//use Filament\Forms\Form;
//use Filament\Notifications\Notification;
//use Filament\Pages\Page;
//use Filament\Support\Enums\ActionSize;
//use Filament\Support\Exceptions\Halt;
//use Filament\Resources\Pages\EditRecord as BaseEdit;
//use Illuminate\Contracts\Support\Htmlable;
//use Illuminate\Database\Eloquent\Model;
//use Spatie\Permission\Models\Role;
//use Wallo\FilamentSelectify\Components\ToggleButton;
//
//class Settings extends Page implements HasForms, HasActions
//{
//
//    use InteractsWithForms, InteractsWithActions;
//
//    public ?array $data = [];
//
//    protected static ?string $navigationIcon = 'heroicon-o-cog';
//    protected static ?string $activeNavigationIcon = 'heroicon-s-cog';
//
//    protected static ?string $navigationGroup = 'Yetkili İşlemleri';
//    protected static ?string $navigationLabel = 'Ayarlar';
//    protected static ?string $slug = 'settingsa';
//
//    protected ?string $subheading = 'Ayarları burada görüntüleyebilir, değiştirebilirsiniz.';
//
//    protected static ?string $title = 'Ayarlar';
//
//    protected static string $view = 'filament.admin.pages.settings';
//
//
////    public function mount(): void
////    {
////        $this->form->fill([
////            'msg' => '1148179348524900364',
////        ]);
////    }
//
//    public function form(Form $form): Form
//    {
//        return $form
//            ->schema([
//                Section::make('Sunucu Ayarları')
//                    ->live()
//                    ->description('Aşağıdan sunucu ayarlarınızı güncelleyebilirsiniz.')
//                    ->columns(2)
//                    ->schema([
//                Fieldset::make('Public (Herkese Açık)')
//                    ->live()
////                    ->description('Aşağıdan sunucu ayarlarınızı güncelleyebilirsiniz.')
//                    ->columns(2)
//                    ->schema([
//                        ToggleButton::make('public')
//                            ->reactive()
//                            ->label('Reklam yapılsın mı?')
//                            ->onLabel('Evet')
//                            ->offLabel('Hayır')
//                            ->validationAttribute('Mesaj Log Kanal ID'),
//                        ToggleButton::make('public')
//                            ->reactive()
//                            ->label('Özel sunucu daveti atılsın mı?')
//                            ->onLabel('Evet')
//                            ->offLabel('Hayır')
//                            ->validationAttribute('Mesaj Log Kanal ID'),
//                        ]),
//                        Fieldset::make('Private (Özel)')
//                            ->live()
////                            ->description('Aşağıdan sunucu ayarlarınızı güncelleyebilirsiniz.')
//                            ->columns(2)
//                            ->schema([
//                        ToggleButton::make('private')
//                            ->reactive()
//                            ->label('Abonelik kontrol sistemi açılsın mı?')
//                            ->onLabel('Evet')
//                            ->offLabel('Hayır')
//                            ->validationAttribute('Mesaj Log Kanal ID'),
//                        ToggleButton::make('private')
//                            ->reactive()
//                            ->label('Boost kontrol sistemi açılsın mı?')
//                            ->onLabel('Evet')
//                            ->offLabel('Hayır')
//                            ->validationAttribute('Mesaj Log Kanal ID'),
//])
//                    ]),
//                Section::make('Kanal')
//                    ->live()
//                    ->description('Aşağıdan kanal bilgilerini güncelleyebilirsiniz.')
//                    ->columns(3)
//                    ->schema([
//                        TextInput::make('msg')
//                            ->reactive()
//                            ->mask('1148179348524900364')
//                            ->label('Mesaj Log Kanal ID')
//                            ->placeholder('1148179348524900364')
//                            ->helperText('İlgili kanala sağ tıklayarak ID bilgisini görebilirsin.')
//                            ->validationAttribute('Mesaj Log Kanal ID')
//                            ->default('1148179348524900364'),
////                            ->maxLength(255),
//                        TextInput::make('voice')
//                            ->reactive()
//                            ->mask('1148179348524900364')
//                            ->label('Sesli Log Kanal ID')
//                            ->placeholder('1148179348524900364')
//                            ->helperText('İlgili kanala sağ tıklayarak ID bilgisini görebilirsin.')
//                            ->validationAttribute('Sesli Log Kanal ID')
//                            ->default('1148179348524900364'),
//                        TextInput::make('loginlogout')
//                            ->reactive()
//                            ->mask('1148179348524900364')
//                            ->label('Giriş Çıkış Log Kanal ID')
//                            ->placeholder('1148179348524900364')
//                            ->helperText('İlgili kanala sağ tıklayarak ID bilgisini görebilirsin.')
//                            ->validationAttribute('Giriş Çıkış Log Kanal ID')
//                            ->default('1148179348524900364'),
//                        TextInput::make('moderation')
//                            ->reactive()
//                            ->mask('1148179348524900364')
//                            ->label('Moderasyon Log Kanal ID')
//                            ->placeholder('1148179348524900364')
//                            ->helperText('İlgili kanala sağ tıklayarak ID bilgisini görebilirsin.')
//                            ->validationAttribute('Moderasyon Log Kanal ID')
//                            ->default('1148179348524900364'),
//                        TextInput::make('announce')
//                            ->reactive()
//                            ->mask('1148179348524900364')
//                            ->label('Duyuru Kanal ID')
//                            ->placeholder('1148179348524900364')
//                            ->helperText('İlgili kanala sağ tıklayarak ID bilgisini görebilirsin.')
//                            ->validationAttribute('Duyuru Kanal ID')
//                            ->default('1148179348524900364'),
//                        TextInput::make('rule')
//                            ->reactive()
//                            ->mask('1148179348524900364')
//                            ->label('Kurallar Kanal ID')
//                            ->placeholder('1148179348524900364')
//                            ->helperText('İlgili kanala sağ tıklayarak ID bilgisini görebilirsin.')
//                            ->validationAttribute('Kurallar Kanal ID')
//                            ->default('1148179348524900364'),
////                            ->maxLength(255),
//                    ]),
//                Section::make('Rol')
//                    ->live()
//                    ->columns(4)
//                    ->description('Aşağıdan rol bilgilerini güncelleyebilirsiniz.')
//                    ->schema([
//                        Select::make('bot_role')
//                            ->label('Bot Rol ID')
//                            ->preload()
//                            ->live()
//                            ->placeholder('BOT')
//                            ->native(false)
//                            ->options([
//                                'BOT' => 'BOT',
//                                'Üye'  => 'Üye',
//                                'Kayıtsız' => 'Kayıtsız',
//                                'VIP' => 'VIP',
//                                'Yönetici' => 'Yönetici',
//                                'Moderatör' => 'BOT'
//                            ])
//                            ->validationAttribute('Bot Rol ID'),
//                        Select::make('member_role')
//                            ->label('Üye Rol ID')
//                            ->placeholder('Üye')
//                            ->preload()
//                            ->live()
//                            ->native(false)
//                            ->options([
//                                'BOT' => 'BOT',
//                                'Üye'  => 'Üye',
//                                'Kayıtsız' => 'Kayıtsız',
//                                'VIP' => 'VIP',
//                                'Yönetici' => 'Yönetici',
//                                'Moderatör' => 'BOT'
//                            ]),
//                        Select::make('unregistered_role')
//                            ->label('Kayıtsız Rol ID')
//                            ->preload()
//                            ->live()
//                            ->placeholder('Kayıtsız')
//                            ->native(false)
//                            ->options([
//                                'BOT' => 'BOT',
//                                'Üye'  => 'Üye',
//                                'Kayıtsız' => 'Kayıtsız',
//                                'VIP' => 'VIP',
//                                'Yönetici' => 'Yönetici',
//                                'Moderatör' => 'BOT'
//                            ]),
//                        Select::make('vip_role')
//                            ->label('VIP Rol ID')
//                            ->preload()
//                            ->live()
//                            ->placeholder('VIP')
//                            ->native(false)
//                            ->options([
//                                'BOT' => 'BOT',
//                                'Üye'  => 'Üye',
//                                'Kayıtsız' => 'Kayıtsız',
//                                'VIP' => 'VIP',
//                                'Yönetici' => 'Yönetici',
//                                'Moderatör' => 'BOT'
//                            ]),
//                    ]),
//                Section::make('Bot')
//                    ->live()
//                    ->columns(2)
//                    ->description('Aşağıdan bot bilgilerini güncelleyebilirsiniz.')
//                    ->schema([
//                        TextInput::make('token')
//                            ->label('Token')
//                            ->maxLength(255)
//                            ->validationAttribute('Bot Tokeni'),
//                        TextInput::make('id')
//                            ->label('ID')
//                            ->maxLength(255)
//                            ->validationAttribute('Bot ID'),
//                    ]),
//            ]);
//    }
//
//    public static function save(): string
//    {
//        return 'ha';
//    }
//
//    public static function getRelations(): array
//    {
//        return [
//            //
//        ];
//    }
//
//    public static function getPages(): array
//    {
//        return [
//        ];
//    }
//
//    protected function hasFullWidthFormActions(): bool
//    {
//        return true;
//    }
//
////    protected function getActions(): array
////    {
////        return [
////            Action::make('save')
////                ->label('Kaydet')
////                ->successNotification(
////                    Notification::make()->title('Başarılı')->body('Kaydedildi')->success()->send()
////                ),
////        ];
////    }
//
////    protected function getHeaderActions(): array
////    {
////        return [
////            Action::make('save')
////                ->label('Kaydet')
////                ->successNotification(
////                    Notification::make()->title('Başarılı')->body('Kaydedildi')->success()->send()
////                ),
////        ];
////    }
//
//
//    protected function getCachedFormActions(): array
//    {
//        return [
//
//                Action::make('success')
//                    ->label('Kaydet')
//                    ->size(ActionSize::Small)
//                    ->sendSuccessNotification()
//                    ->url(url('/admin'))
//                    ->successRedirectUrl(url: url('/'))
//                    ->successNotificationTitle('Başarılı!')
//        ];
//    }
//
//    protected function getFormActions(): array
//    {
//        return [
//            Action::make('success')
//                ->label('Kaydet')
//                ->url(url('/admin'))
//                ->size(ActionSize::Small)
//                ->successRedirectUrl(url: url('/'))
//            ->sendSuccessNotification()
//            ->successNotificationTitle('Başarılı!'),
//        ];
//    }
//
//}
//
//
