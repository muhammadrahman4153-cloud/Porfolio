<?php
namespace App\Providers;

use App\Models\Profile;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Data profil dibagikan ke layout frontend (navbar & footer)
        View::composer('layouts.app', function ($view) {
            $view->with('site', Profile::first());
        });
    }
}
