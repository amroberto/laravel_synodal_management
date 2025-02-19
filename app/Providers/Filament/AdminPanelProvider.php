<?php

namespace App\Providers\Filament;

use auth;
use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use App\Enums\UserTypeEnum;
use Filament\PanelProvider;
use Filament\Pages\Dashboard;
use Filament\Facades\Filament;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Filament\Tables\Columns\Column;
use Filament\Widgets\AccountWidget;
use Filament\Forms\Components\Field;
use App\Http\Middleware\VerifyIsAdmin;
use Filament\Widgets\FilamentInfoWidget;
use Filament\Http\Middleware\Authenticate;
use App\Filament\App\Resources\ParishResource;
use App\Http\Middleware\EnsureAdmin;
use App\Http\Middleware\EnsureUser;
use App\Http\Middleware\RedirectNotActiveUser;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class AdminPanelProvider extends PanelProvider
{   
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->bootUsing(function(){
                Field::configureUsing(function (Field $field){
                    $field->translateLabel();
                });

                Column::configureUsing(function (Column $column){
                    $column->translateLabel();
                });
            })
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Indigo,
                'danger' => color::Red,
                'gray' => Color::Slate,
                'info' => Color::Blue,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                EnsureAdmin::class,
                RedirectNotActiveUser::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
            
    }
}
