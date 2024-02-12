<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\ActiveFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Artisan;
use Throwable;

class LandlordTenant extends Model
{
    use HasFactory;
    use SoftDeletes;
    use ActiveFilter;

    protected $fillable = ['id', 'created_by', 'name', 'slug', 'database', 'domain', 'status'];

    protected static function booted(): void
    {
        static::created(fn (LandlordTenant $model) => $model->setDatabaseName());
        static::updated(fn (LandlordTenant $model) => $model->createDatabase());
    }

    private function setDatabaseName(): void
    {
        $databaseName = get_tenant_db_prefix_by_env() . $this?->id;
        $this->update([
            'database' => $databaseName,
        ]);
    }

    /**
     * @throws Throwable
     */
    public function createDatabase(): void
    {
        $databaseName = config('multitenancy.prefix') . $this?->id;
        Artisan::call('create:db', [
            'dbname' => $databaseName,
        ]);

        Artisan::call("tenants:migrate", [
            'tenantDB' => $databaseName,
            // '--fresh' => true,
        ]);
    }
}
