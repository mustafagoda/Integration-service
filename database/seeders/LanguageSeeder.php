<?php

namespace Database\Seeders;

use App\Domain\Shared\Enum\ActiveStatusEnum;
use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Language::query()->updateOrCreate(['slug' => 'ar'], [
            'slug' => 'ar',
            'name' => translate_for_json_column('messages.dynamic_settings.arabic', ['ar', 'en']),
            'direction' => 'rtl',
            'is_default' => true,
            'status' => ActiveStatusEnum::ACTIVE->value,
            'icon' => 'template ui icon'
        ]);

        Language::query()->updateOrCreate(['slug' => 'en'], [
            'slug' => 'en',
            'name' => translate_for_json_column('messages.dynamic_settings.english', ['ar', 'en']),
            'direction' => 'ltr',
            'is_default' => false,
            'status' => ActiveStatusEnum::ACTIVE->value,
            'icon' => 'template ui icon'
        ]);
    }
}
