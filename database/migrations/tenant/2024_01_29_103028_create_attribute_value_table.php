<?php

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
        Schema::create('attribute_value', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('attribute_category_id')->constrained('attribute_categories');
            $table->foreignId('attribute_id')->constrained();
            $table->text('value')->nullable();
            $table->string('attribute_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_value');
    }
};
