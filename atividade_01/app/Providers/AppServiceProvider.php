<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;


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
    public function boot()
    {
        Paginator::useBootstrap();
    }


        // app/Providers/AuthServiceProvider.php
    protected $policies = [
        Book::class => BookPolicy::class,
        User::class => UserPolicy::class,
        // Adicionar outras models: Author, Publisher, Category
    ];
}
