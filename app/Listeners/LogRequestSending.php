<?php

declare(strict_types=1);

namespace App\Listeners;

use Illuminate\Http\Client\Events\RequestSending;
use Illuminate\Support\Str;

class LogRequestSending
{
    public function handle(RequestSending $event): void
    {
        $url = $event->request->url();
        $servicesWithSuppliers = array_filter(config('services'), function ($service) {
            return isset($service['suppliers']);
        });

        collect($servicesWithSuppliers)->map(function ($service, $serviceKey) use ($url, $event) {
            return collect($service['suppliers'])->map(function ($supplier, $supplierKey) use ($url, $serviceKey, $event) {
                if (Str::contains($url, $supplierKey)) {
                    $logChannel = setup_dynamic_log_channel($serviceKey, $supplierKey, 'info');

                    $logChannel->info('Request is being sent:', [
                        'method' => $event->request->method(),
                        'url' => $url,
                        'body' => $event->request->body(),
                        //'user' => auth()->user()->id,
                        //'tenant_id' => session()->get('tenant_id_'.crc32(get_request_domain())),
                        //'options' => $event->options,
                    ]);
                }
                return false;
            });
        });
    }
}
