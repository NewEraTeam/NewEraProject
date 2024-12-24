<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; // Import Log facade

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
        try {
            $pdo = DB::connection()->getPdo();

            if (!$pdo) {
                Log::error("PDO instance is null. Database connection failed.");
                return;
            }

            Log::info("Connected to database successfully: " . $pdo->getAttribute(\PDO::ATTR_CONNECTION_STATUS));
        } catch (\Exception $e) {
            Log::error("Database connection error: " . $e->getMessage());
        }
    }

}
