<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModelTest extends TestCase
{
    /**
     * Test User model exists
     *
     * @return void
     */
    public function testUserModelExists()
    {
        $user = factory(\App\User::class)->create();
        $this->assertNotNull($user);

        $user->forceDelete();
    }

    /**
     * Test User has an Account relationship
     *
     * @return void
     */
    public function testUserModelHasAnAccountRelationship()
    {

        $user = factory(\App\User::class)->create();
        $this->assertNotNull($user->account());

        $user->forceDelete();
    }
}
