<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserActivityApiTest extends TestCase
{
    use MakeUserActivityTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateUserActivity()
    {
        $userActivity = $this->fakeUserActivityData();
        $this->json('POST', '/api/v1/userActivities', $userActivity);

        $this->assertApiResponse($userActivity);
    }

    /**
     * @test
     */
    public function testReadUserActivity()
    {
        $userActivity = $this->makeUserActivity();
        $this->json('GET', '/api/v1/userActivities/'.$userActivity->id);

        $this->assertApiResponse($userActivity->toArray());
    }

    /**
     * @test
     */
    public function testUpdateUserActivity()
    {
        $userActivity = $this->makeUserActivity();
        $editedUserActivity = $this->fakeUserActivityData();

        $this->json('PUT', '/api/v1/userActivities/'.$userActivity->id, $editedUserActivity);

        $this->assertApiResponse($editedUserActivity);
    }

    /**
     * @test
     */
    public function testDeleteUserActivity()
    {
        $userActivity = $this->makeUserActivity();
        $this->json('DELETE', '/api/v1/userActivities/'.$userActivity->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/userActivities/'.$userActivity->id);

        $this->assertResponseStatus(404);
    }
}
