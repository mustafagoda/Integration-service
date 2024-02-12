<?php

namespace App\Http\Controllers\Tenant;

use App\Domain\Shared\Responder\Interfaces\IApiHttpResponder;
use App\Domain\Tenant\Settings\Services\Interfaces\ISettingService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\SettingUpdateRequest;
use App\Http\Resources\Tenant\SettingResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Throwable;

class SettingController extends Controller
{
    /**
     * @param ISettingService $settingService
     * @param IApiHttpResponder $apiHttpResponder
     */
    public function __construct(private readonly ISettingService $settingService,private readonly IApiHttpResponder $apiHttpResponder)
    {
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return SettingResource::collection($this->settingService->listAllSettings());
    }

    /**
     * @param string $settingSlug
     * @return SettingResource
     */
    public function show(string $settingSlug): SettingResource
    {
       return new SettingResource($this->settingService->showSetting($settingSlug));
    }

    /**
     * @param string $settingSlug
     * @param SettingUpdateRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(string $settingSlug, SettingUpdateRequest $request): JsonResponse
    {
        return $this->apiHttpResponder->response(message: $this->settingService->updateSetting($settingSlug,$request->validated()));
    }
}
