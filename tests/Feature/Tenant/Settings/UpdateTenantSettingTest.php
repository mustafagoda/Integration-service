<?php

namespace Tests\Feature\Tenant\Settings;

use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UpdateTenantSettingTest extends TestCase
{
    public function testUnAuthUserCannotShowTenantSettingBySlug()
    {
        $response = $this->putJson(route('settings.update',['slug' => 'xyz']));
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
