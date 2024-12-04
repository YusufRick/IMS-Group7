<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
         // Get settings from database
         $settings = DB::table('settings')->first();
         // If settings exist, use them; otherwise, use default values
         if ($settings) {
             $appTitle = $settings->app_title;
             $footerText = $settings->footer_title;
             $appLogo = $settings->app_logo ?? 'default.jpg';
             $loginLogo = $settings->login_logo ?? 'default.jpg';
             $faviconLogo = $settings->favicon_logo ?? 'default.jpg';
         } else {
             // Default values if settings don't exist
             $appTitle = 'Your Default App Title';
             $footerText = 'footer text';
             $appLogo = 'default.jpg';
             $loginLogo = 'default.jpg';
             $faviconLogo = 'default.jpg';
         }
 
         // Share settings with all views
         view()->share('app_title', $appTitle);
         view()->share('app_logo', $appLogo);
         view()->share('login_logo', $loginLogo);
         view()->share('favicon_logo', $faviconLogo);
          view()->share('footer_text', $footerText);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
