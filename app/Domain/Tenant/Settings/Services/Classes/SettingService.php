<?php

namespace App\Domain\Tenant\Settings\Services\Classes;

use App\Domain\Shared\Enum\AttributeTypeEnum;
use App\Domain\Tenant\Settings\Repositories\Interfaces\ITenantSettingRepository;
use App\Domain\Tenant\Settings\Services\Interfaces\ISettingService;
use App\Exceptions\Custom\ApiCustomException;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class SettingService implements ISettingService
{
    /**
     * @param ITenantSettingRepository $settingRepository
     */
    public function __construct(private readonly ITenantSettingRepository $settingRepository)
    {
    }

    /**
     * @return Collection|array
     */
    public function listAllSettings(): Collection|array
    {
        return $this->settingRepository->listAllBy();
    }

    /**
     * @param string $settingSlug
     * @return Model|Builder
     */
    public function showSetting(string $settingSlug): Model|Builder
    {
        return $this->settingRepository->firstOrFail(conditions: ['slug' => $settingSlug],relations: ['attributeCategories' => function ($category) {
            $category->with(['attributes' => function ($query) {
                $query->with(['attributeOptions', 'attributeOptions.attributable']);
            }]);
        }]);
    }

    /**
     * @throws Throwable
     */
    public function updateSetting(string $settingSlug, array $data): Application|array|string|Translator|\Illuminate\Contracts\Foundation\Application|null
    {
        $dynamicSetting = $this->showSetting($settingSlug);

        throw_if(empty($dynamicSetting->attributeCategories), new ApiCustomException('validation.this_attribute_category_not_exist',Response::HTTP_NOT_FOUND));

        throw_if(! in_array($data['attribute_slug'], data_get($dynamicSetting,'attributeCategories.*.attributes.*.slug')),new ApiCustomException('validation.this_attribute_not_exist',Response::HTTP_NOT_FOUND));
        foreach ($dynamicSetting->attributeCategories as $category) {
            foreach ($category->attributes as $attribute) {
                if ($attribute->slug == $data['attribute_slug']) {
                    $value = $data['value'];

                    if ($attribute->type === AttributeTypeEnum::FILE->value){
                        $value = upload_file($value,$data['attribute_slug']);
                    }

                    if ($attribute->type === AttributeTypeEnum::PASSWORD->value){
                        $value = Crypt::encrypt((string) $value);
                    }

                    $attribute->pivot->update(['value' => $value,'attribute_type' => $attribute->type]);
                }
            }
        }

        return trans('messages.updated_successfully');
    }
}
