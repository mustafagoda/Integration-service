<?php

declare(strict_types=1);

namespace App\Providers;

use App\Domain\Shared\Responder\Classes\ApiHttpResponder;
use App\Domain\Shared\Responder\Interfaces\IApiHttpResponder;
use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Model::preventLazyLoading(! app()->isProduction());
        $this->app->singleton(IApiHttpResponder::class, ApiHttpResponder::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        DB::whenQueryingForLongerThan(500, function (Connection $connection, QueryExecuted $event) {
            Log::warning('Slow query detected', [
                'query' => $event->sql,
                'bindings' => $event->bindings,
                'time' => $event->time,
                'connection' => $connection->getName(),
            ]);
        });

        $executedQueries = [];

        DB::listen(function ($query) use (&$executedQueries) {
            $sql = $query->sql;
            $bindings = $query->bindings;
            $time = $query->time;

            $identifier = md5($sql . serialize($bindings));

            if (in_array($identifier, $executedQueries, true)) {
                Log::warning('Repeated query detected within the same request', [
                    'sql' => $sql,
                    'bindings' => $bindings,
                    'time' => $time,
                ]);
            }
            $executedQueries[] = $identifier;
        });
    }
}
