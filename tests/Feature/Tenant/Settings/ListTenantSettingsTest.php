<?php

declare(strict_types=1);

namespace Tests\Feature\Tenant\Settings;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ListTenantSettingsTest extends TestCase
{
    public function testUnAuthUserCannotListTenantSettings()
    {

        $response = $this->getJson(route('settings.index'), [
            'origin' => $this->getTestTenantDetails()->domain,
        ]);
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function testAuthUserCanListTenantSettings()
    {
        $this->switchToTenantDBTest();
        $user = User::factory()->create();

        reset_landlord_connection();
        $this->actingAs($user);
        $response = $this
            ->getJson(route('settings.index'), [
                'origin' => $this->getTestTenantDetails()->domain,
            ]);

        $response->assertStatus(Response::HTTP_OK);
    }
}
