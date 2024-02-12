<?php

declare(strict_types=1);

use App\Domain\Shared\Services\Interfaces\ITenantManager;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Psr\Log\LoggerInterface;

if (! function_exists('get_request_domain')) {
    function get_request_domain(): string
    {
        return request()->getHost();
    }
}

if (! function_exists('get_current_connection')) {
    function get_current_connection()
    {
        return request()->getHost() || request()->route('tenant') ? config('tenancy.tenant_connection') : config('tenancy.landlord_connection');
    }
}

if (! function_exists('get_tenant_db_name')) {
    function get_tenant_db_name($database)
    {
    }
}

if (! function_exists('switch_db_connection_by_identifier')) {
    /**
     * @return void
     */
    function switch_db_connection_by_identifier(): void
    {
        if (DB::getDefaultConnection() !== 'tenant') {
            $identifier = request()->route('tenant_slug') ?? get_header_origin();

            if ($identifier) {
                resolve(ITenantManager::class)->loadTenant($identifier);
            }
        }
    }
}

if (! function_exists('get_header_origin')) {
    /**
     * @return bool|string
     */
    function get_header_origin(): bool|string
    {
        $requestHeader = request()->header();
        if (isset($requestHeader['origin']) && Arr::first($requestHeader['origin']) !== null) {
            return Arr::first($requestHeader['origin']);
        }
        return false;
    }
}

if (! function_exists('get_tenant_cache_key')) {
    /**
     * @return string
     */
    function get_tenant_cache_key(): string
    {
        return Str::replace('_', ':', DB::getDatabaseName()) . ':';
    }
}


if (! function_exists('get_tenant_db_prefix_by_env')) {
    /**
     * @return string
     */
    function get_tenant_db_prefix_by_env(): string
    {
        return (config('app.env') === 'testing') ? config('multitenancy.prefix_test') : config('multitenancy.prefix');
    }
}

if (! function_exists('reset_landlord_connection')) {
    /**
     * @return void
     * @auther Mustafa Goda
     */
    function reset_landlord_connection(): void
    {
        config([
            'database.default' => config('multitenancy.landlord_connection'),
        ]);
    }
}

if (! function_exists('get_supplier_config_file')) {
    function get_supplier_config_file(string $service, string $supplierName): bool|string
    {
        return realpath(dirname(__FILE__) . '/Domain/' . Str::ucfirst($service) . DIRECTORY_SEPARATOR . 'Suppliers' . DIRECTORY_SEPARATOR . Str::ucfirst($supplierName) . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . $supplierName . '.php');
    }
}

if (! function_exists('setup_dynamic_log_channel')) {
    function setup_dynamic_log_channel($service, $supplier, $logType): LoggerInterface
    {
        $day = Carbon::today()->format('Y-m-d');

        $logPath = storage_path("logs/$service/$supplier/$day/{$service}_{$supplier}_{$logType}_$day.log");

        File::makeDirectory(dirname($logPath), 0755, true, true);

        if (! is_writable(dirname($logPath))) {
            chmod(dirname($logPath), 0755);

            if (! is_writable(dirname($logPath))) {
                throw new RuntimeException("The directory is not writable: " . dirname($logPath));
            }
        }

        config([
            'logging.channels.dynamic' => [
                'driver' => 'daily',
                'path' => $logPath,
                'level' => env('LOG_LEVEL', 'debug'),
                'days' => 1,
                'replace_placeholders' => true,
            ],
        ]);

        return Log::channel('dynamic');
    }
}

if (! function_exists('exchange_rate')) {
    /**
     * @param string $currencySlug
     * @return float
     */
    function exchange_rate(string $currencySlug): float
    {
        return 1;
    }
}

if (! function_exists('get_permissions_with_groups')) {
    /**
     * @param string $type
     * @return array
     * @throws ReflectionException
     */
    function get_permissions_with_groups(string $type): array
    {
        $loader = require base_path('vendor/autoload.php');
        $parentArray = [];
        foreach ($loader->getClassMap() as $class => $file) {
            $methods = [];

            if (preg_match('/[a-z]+Controller$/', $class)
                && strpos($class, 'Controllers\\' . $type)
            ) {
                $reflection = new ReflectionClass($class);
                $category = substr($reflection->getShortName(), 0, strrpos($reflection->getShortName(), "C"));
                if (str_replace('Controller', '', $reflection->getShortName()) !== '__construct') {
                    foreach ($reflection->getMethods() as $method) {
                        if ($method->class === $reflection->getName()) {
                            $methods[] = Str::kebab($method->name);
                        }
                    }
                    $parentArray[$category] = array_values(array_diff($methods, ['__construct']));
                }
            }
        }
        return $parentArray;
    }
}

if (! function_exists('translate_for_json_column')) {
    /**
     * @param string $translateKey
     * @param array $languageSlugs
     * @return array
     */
    function translate_for_json_column(string $translateKey, array $languageSlugs = ['ar']): array
    {
        $translatedArray = [];
        foreach ($languageSlugs as $languageSlug) {
            $translatedArray[$languageSlug] = trans(key: $translateKey, locale: $languageSlug);
        }
        return $translatedArray;
    }
}

if (! function_exists('upload_file')) {
    /**
     * @param mixed $file
     * @param string $folderName
     * @return string
     */
    function upload_file(mixed $file, string $folderName): string
    {
        $filePath = request()->getHost() ? generate_path(action: $folderName, atTime: (string) time()) : 'landlord/' . Str::lower(Str::kebab($folderName));
        $nickName = generate_file_random_name($file->extension());
        Storage::disk('public')->put($filePath . '/' . $nickName, File::get($file));
        return $filePath . '/' . $nickName;
    }
}

if (! function_exists('generate_path')) {
    /**
     * @param string $action
     * @param string $atTime
     * @return string
     */
    function generate_path(string $action, string $atTime): string
    {
        $path = config('database.connections.tenant.database') . DIRECTORY_SEPARATOR .
            get_header_origin() . DIRECTORY_SEPARATOR;


        $path .= date('d-m-Y') . DIRECTORY_SEPARATOR .
            $atTime . DIRECTORY_SEPARATOR .
            Str::lower(Str::kebab($action));

        return $path;
    }
}

if (! function_exists('generate_file_random_name')) {
    /**
     * @param string $extension
     * @return string
     */
    function generate_file_random_name(string $extension): string
    {
        $time = time();
        $str_random = Str::random(8);
        return $time . '_' . $str_random . '.' . $extension;
    }
}

if (! function_exists('reset_landlord_connection')) {
    /**
     * @return void
     */
    function reset_landlord_connection(): void
    {
        config([
            'database.default' => config('multitenancy.landlord_connection'),
        ]);
    }
}

if (! function_exists('get_tenant_db_prefix_by_env')) {
    /**
     * @return string
     * @auther Mustafa Goda
     */
    function get_tenant_db_prefix_by_env(): string
    {
        return (config('app.env') === 'testing') ? config('tenancy.prefix_test') : config('tenancy.prefix');
    }
}
