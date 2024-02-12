<?php

use App\Domain\Shared\Enum\ActiveStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->enum('status', array_column(ActiveStatusEnum::cases(), 'value'))->default(ActiveStatusEnum::ACTIVE->value);
            $table->string('slug',11)->unique();
            $table->jsonb('name');
            $table->boolean('is_default')->default(false);
            $table->string('icon',191)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
