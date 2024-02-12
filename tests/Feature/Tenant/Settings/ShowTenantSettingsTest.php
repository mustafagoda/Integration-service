<?php

declare(strict_types=1);

namespace Tests\Feature\Tenant\Settings;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ShowTenantSettingsTest extends TestCase
{

    public function testUnAuthUserCannotShowTenantSettingBySlug()
    {
        $this->switchToTenantDBTest();
        reset_landlord_connection();
        $response = $this->getJson(route('settings.show', [
            'slug' => 'xyz',
        ]));
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function testAuthUserCanShowTenantSettingBySlugNotfound()
    {
        $this->switchToTenantDBTest();
        $user = User::factory()->create();
        reset_landlord_connection();
        $this->actingAs($user);

        $response = $this
            ->getJson(route('settings.show', [
                'slug' => 'xyz',
            ]), [
                'origin' => $this->getTestTenantDetails()->domain,
            ]);

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function testAuthUserCanShowTenantSettingBySlug()
    {
        $this->switchToTenantDBTest();
        $user = User::factory()->create();
        reset_landlord_connection();
        $this->actingAs($user);

        $response = $this
            ->getJson(route('settings.show', [
                'slug' => 'languages',
            ]), [
                'origin' => $this->getTestTenantDetails()->domain,
            ]);

        $response->assertOk()->assertJsonStructure([
            'data' => [
                'name',
                'slug',
                'description',
                'icon',
                'status',
                'categories' => [
                    '*' => [
                        'name',
                        'slug',
                        'description',
                        'icon',
                        'status',
                        'attributes' => [
                            '*' => [
                                'name',
                                'slug',
                                'status',
                                'placeholder',
                                'validation',
                                'icon',
                                'field_type',
                                'value',
                                'tooltip',
                            ],
                        ],
                    ],
                ],
            ],
        ]);
    }
}
