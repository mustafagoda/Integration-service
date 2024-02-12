<?php

declare(strict_types=1);

namespace App\Listeners;

use Illuminate\Http\Client\Events\RequestSending;
use Illuminate\Support\Str;

class LogConnectionFailed
{
    /**
     * Handle the event.
     */
    public function handle(RequestSending $event): void
    {
        $url = $event->request->url();
        $servicesWithSuppliers = array_filter(config('services'), function ($service) {
            return isset($service['suppliers']);
        });

        collect($servicesWithSuppliers)->map(function ($service, $serviceKey) use ($url, $event) {
            return collect($service['suppliers'])->map(function ($supplier, $supplierKey) use ($url, $serviceKey, $event) {
                if (Str::contains($url, $supplierKey)) {
                    $logChannel = setup_dynamic_log_channel($serviceKey, $supplierKey, 'error');

                    $logChannel->info('Connection failed:', [
                        'url' => $url,
                        'error' => $event->exception->getMessage(),
                    ]);
                }
                return false;
            });
        });
    }
}
