<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(UserService::class, function ($app) {
            return new UserService();
        });
        $this->app->singleton(PropertyService::class, function ($app) {
            return new PropertyService();
        });
        $this->app->singleton(LeaseService::class, function ($app) {
            return new LeaseService();
        });


        // $this->app->singleton(InventionService::class, function ($app) {
        //     return new InventionService(
        //         $app->make(UserManagementService::class)
        //     );
        // });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::morphMap([
            'user'     => \App\Models\User::class,
            'property' => \App\Models\Property::class,
        ]);
    }
}