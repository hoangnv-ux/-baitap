<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\User\PostRepositoryInterface;
use App\Repositories\Eloquent\User\PostRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->bind(
        //     PostRepositoryInterface::class,
        //     PostRepository::class
        // );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (app()->environment('testing')) {
            $dbName = config('database.connections.mysql.database');
            $expectedDbName = env('DB_DATABASE');

            if ($dbName !== $expectedDbName) {
                throw new \Exception('Wrong database for testing! Config: ' . $dbName . ' | Expected: ' . $expectedDbName);
            }
        }
    }
}
