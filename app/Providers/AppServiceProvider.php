<?php

namespace App\Providers;

use App\Models\RequestUser;
use Illuminate\pagination\Paginator;
use Illuminate\Support\ServiceProvider;

use Kutia\Larafirebase\Facades\Larafirebase;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();

        // view()->composer('*', function ($view) {
        //     $requestPeminjamanBelumDibaca = RequestUser::where('status', '=', 'pending')
        //         ->where('dibaca', '=', false)
        //         ->orderBy('id', 'desc')
        //         ->take(5) // Ambil 5 request terbaru
        //         ->get();

        //     $view->with('requestPeminjamanBelumDibaca', $requestPeminjamanBelumDibaca);
        // });
    }
}
