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
        Schema::create('attribute_categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('dynamic_setting_id')->constrained('dynamic_settings');
            $table->enum('status', array_column(ActiveStatusEnum::cases(), 'value'))->default(ActiveStatusEnum::ACTIVE->value);
            $table->string('slug')->unique();
            $table->jsonb('name');
            $table->jsonb('description');
            $table->string('icon',191)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_categories');
    }
};
