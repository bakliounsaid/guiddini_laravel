<?php
namespace GuiddiniLaravel;
use Illuminate\Support\ServiceProvider;

class GuiddiniServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../src/Database/Migrations');

    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}