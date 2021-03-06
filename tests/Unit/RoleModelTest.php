<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Role;
use App\Account;

class RoleModelTest extends TestCase
{
     /**
     * Test Role model exists
     *
     * @return void
     */
    public function testRoleModelExists()
    {
        $role = factory(Role::class)->create();
        $this->assertNotNull($role);

        $role->forceDelete();
    }


}
