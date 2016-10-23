<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ActivityScheduleApiTest extends TestCase
{
    use MakeActivityScheduleTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateActivitySchedule()
    {
        $activitySchedule = $this->fakeActivityScheduleData();
        $this->json('POST', '/api/v1/activitySchedules', $activitySchedule);

        $this->assertApiResponse($activitySchedule);
    }

    /**
     * @test
     */
    public function testReadActivitySchedule()
    {
        $activitySchedule = $this->makeActivitySchedule();
        $this->json('GET', '/api/v1/activitySchedules/'.$activitySchedule->id);

        $this->assertApiResponse($activitySchedule->toArray());
    }

    /**
     * @test
     */
    public function testUpdateActivitySchedule()
    {
        $activitySchedule = $this->makeActivitySchedule();
        $editedActivitySchedule = $this->fakeActivityScheduleData();

        $this->json('PUT', '/api/v1/activitySchedules/'.$activitySchedule->id, $editedActivitySchedule);

        $this->assertApiResponse($editedActivitySchedule);
    }

    /**
     * @test
     */
    public function testDeleteActivitySchedule()
    {
        $activitySchedule = $this->makeActivitySchedule();
        $this->json('DELETE', '/api/v1/activitySchedules/'.$activitySchedule->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/activitySchedules/'.$activitySchedule->id);

        $this->assertResponseStatus(404);
    }
}
