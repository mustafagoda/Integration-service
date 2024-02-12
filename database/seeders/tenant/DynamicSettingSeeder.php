<?php

namespace Database\Seeders\tenant;

use App\Models\Language;
use App\Models\Tenant\Attribute;
use App\Models\Tenant\AttributeCategory;
use App\Models\Tenant\AttributeOption;
use App\Models\Tenant\DynamicSetting;
use Illuminate\Database\Seeder;

class DynamicSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $availableTenantLanguages = Language::pluck('slug')->toArray();
        $tenantSettings = config('tenant_settings');

        foreach ($tenantSettings as $tenantSetting) {
            $setting = $this->updateOrCreateSetting($tenantSetting, $availableTenantLanguages);

            if (optional($tenantSetting)['categories']) {
                foreach ($tenantSetting['categories'] as $category) {
                    $attributeCategory = $this->updateOrCreateAttributeCategory($category, $setting, $availableTenantLanguages);

                    foreach ($category['attributes'] as $attribute) {
                        $attributeDB = $this->updateOrCreateAttribute($attribute, $availableTenantLanguages);

                        if (optional($attribute)['options']) {
                            $this->updateOrCreateAttributeOptions($attribute, $attributeDB);
                        }

                        $this->attachAttributeToCategory($attribute, $attributeDB, $attributeCategory);
                    }
                }
            }
        }
    }

    private function updateOrCreateSetting(array $tenantSetting, array $languages): DynamicSetting
    {
        return DynamicSetting::updateOrCreate(
            ['slug' => $tenantSetting['slug']],
            [
                'slug' => $tenantSetting['slug'],
                'name' => translate_for_json_column($tenantSetting['name'], $languages),
                'description' => translate_for_json_column($tenantSetting['description'], $languages),
                'icon' => $tenantSetting['icon'],
            ]
        );
    }

    private function updateOrCreateAttributeCategory(array $category, DynamicSetting $setting, array $languages): AttributeCategory
    {
        return AttributeCategory::updateOrCreate(
            ['slug' => $category['slug'], 'dynamic_setting_id' => $setting->id],
            [
                'slug' => $category['slug'],
                'name' => translate_for_json_column($category['name'], $languages),
                'description' => translate_for_json_column($category['description'], $languages),
                'icon' => $category['icon'],
                'dynamic_setting_id' => $setting->id,
            ]
        );
    }

    private function updateOrCreateAttribute(array $attribute, array $languages): Attribute
    {
        return Attribute::updateOrCreate(
            ['slug' => $attribute['slug']],
            [
                'name' => translate_for_json_column($attribute['name'], $languages),
                'type' => $attribute['type'],
                'validation' => $attribute['validation'],
                'icon' => optional($attribute)['icon'],
                'tooltip' => optional($attribute)['tooltip'] ? translate_for_json_column($attribute['tooltip'], $languages) : [],
                'placeholder' => optional($attribute)['placeholder'] ? translate_for_json_column($attribute['placeholder'], $languages) : [],
            ]
        );
    }

    private function updateOrCreateAttributeOptions(array $attribute, Attribute $attributeDB): void
    {
        $attributeOptions = $attribute['options']::all();
        if (!empty($attributeOptions)) {
            foreach ($attributeOptions as $attributeOption) {
                AttributeOption::updateOrCreate([
                    'attributable_id' => $attributeOption->id,
                    'attributable_type' => $attribute['options'],
                    'attribute_id' => $attributeDB->id,
                ]);
            }
        }
    }

    private function attachAttributeToCategory(array $attribute, Attribute $attributeDB, AttributeCategory $attributeCategory): void
    {
        if ($attributeCategory->attributes()->where('slug', $attribute['slug'])->doesntExist()) {
            $attributeCategory->attributes()->attach($attributeDB, [
                'value' => optional($attribute)['value'] ?? '',
                'attribute_type' => $attribute['type']
            ]);
        }
    }

}
