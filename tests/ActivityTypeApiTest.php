<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ActivityTypeApiTest extends TestCase
{
    use MakeActivityTypeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateActivityType()
    {
        $activityType = $this->fakeActivityTypeData();
        $this->json('POST', '/api/v1/activityTypes', $activityType);

        $this->assertApiResponse($activityType);
    }

    /**
     * @test
     */
    public function testReadActivityType()
    {
        $activityType = $this->makeActivityType();
        $this->json('GET', '/api/v1/activityTypes/'.$activityType->id);

        $this->assertApiResponse($activityType->toArray());
    }

    /**
     * @test
     */
    public function testUpdateActivityType()
    {
        $activityType = $this->makeActivityType();
        $editedActivityType = $this->fakeActivityTypeData();

        $this->json('PUT', '/api/v1/activityTypes/'.$activityType->id, $editedActivityType);

        $this->assertApiResponse($editedActivityType);
    }

    /**
     * @test
     */
    public function testDeleteActivityType()
    {
        $activityType = $this->makeActivityType();
        $this->json('DELETE', '/api/v1/activityTypes/'.$activityType->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/activityTypes/'.$activityType->id);

        $this->assertResponseStatus(404);
    }
}
