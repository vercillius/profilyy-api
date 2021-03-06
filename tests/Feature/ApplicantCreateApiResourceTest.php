<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

use App\Account;
use App\User;
use App\Role;

class ApplicantCreateApiResourceTest extends TestCase
{
    /**
     * Test create applicant unauthenticated
     *
     * @return void
     */
    public function testCreateApplicantUnauthenticated()
    {
        $account = factory(Account::class)->create();
        $data = [
            'api_token' => null,
            'account_id' => $account->id
        ];

        $response = $this->json('POST','/api/applicant',$data);
        $response->assertStatus(401); // unauthenticated

        $account->forceDelete();
    }

    /**
     * Test create applicant authenticated and unauthorized
     *
     * @return void
     */
    public function testCreateApplicantAuthenticatedUnauthorized()
    {
        $random = Str::random(60);
        $account = factory(Account::class)->create();
        $user = factory(User::class)->create(['api_token' => hash('sha256',$random)]);
        $role = factory(Role::class)->create(['name'=>'hr']);
        $data = [
            'api_token' => $random,
            'account_id' => $account->id,
            'role_id' => $role->id
        ];

        $response = $this->json('POST','/api/applicant',$data);
        $response->assertStatus(403); // unauthorized

        $role->forceDelete();
        $account->forceDelete();
        $user->forceDelete();
    }

    /**
     * Test create applicant authenticated and authorized
     *
     * @return void
     */
    public function testCreateApplicantAuthenticatedAuthorized()
    {
        $random = Str::random(60);
        $account = factory(Account::class)->create();
        $user = factory(User::class)->create(['api_token' => hash('sha256',$random)]);
        $role = factory(Role::class)->create(['name'=>'applicant']);
        $data = [
            'api_token' => $random,
            'account_id' => $account->id,
            'role_id' => $role->id
        ];

        $response = $this->json('POST','/api/applicant',$data);
        $response->assertStatus(201); // successfully created

        $role->forceDelete();
        $account->forceDelete();
        $user->forceDelete();
    }
}
