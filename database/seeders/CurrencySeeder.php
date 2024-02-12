<?php

namespace Database\Seeders;

use App\Domain\Shared\Enum\ActiveStatusEnum;
use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::query()->updateOrCreate(['slug' => 'usd'], [
            'slug' => 'usd',
            'name' => translate_for_json_column('messages.dynamic_settings.usd', ['ar', 'en']),
            'is_default' => true,
            'status' => ActiveStatusEnum::ACTIVE->value,
            'icon' => 'template ui icon'
        ]);

        Currency::query()->updateOrCreate(['slug' => 'sar'], [
            'slug' => 'sar',
            'name' => translate_for_json_column('messages.dynamic_settings.sar', ['ar', 'en']),
            'is_default' => false,
            'status' => ActiveStatusEnum::ACTIVE->value,
            'icon' => 'template ui icon'
        ]);

        Currency::query()->updateOrCreate(['slug' => 'egp'], [
            'slug' => 'egp',
            'name' => translate_for_json_column('messages.dynamic_settings.egp', ['ar', 'en']),
            'is_default' => false,
            'status' => ActiveStatusEnum::ACTIVE->value,
            'icon' => 'template ui icon'
        ]);
    }
}
