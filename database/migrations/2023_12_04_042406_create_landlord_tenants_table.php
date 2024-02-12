<?php

declare(strict_types=1);

use App\Domain\Shared\Enum\ActiveStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandlordTenantsTable extends Migration
{
    public function up(): void
    {
        Schema::create('landlord_tenants', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('created_by')->constrained('users');
            $table->enum('status', array_column(ActiveStatusEnum::cases(), 'value'))->default(ActiveStatusEnum::ACTIVE->value);
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('domain')->unique();
            $table->string('database')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landlord_tenants');
    }
}
