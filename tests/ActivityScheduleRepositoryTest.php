<?php

use App\Models\ActivitySchedule;
use App\Repositories\ActivityScheduleRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ActivityScheduleRepositoryTest extends TestCase
{
    use MakeActivityScheduleTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ActivityScheduleRepository
     */
    protected $activityScheduleRepo;

    public function setUp()
    {
        parent::setUp();
        $this->activityScheduleRepo = App::make(ActivityScheduleRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateActivitySchedule()
    {
        $activitySchedule = $this->fakeActivityScheduleData();
        $createdActivitySchedule = $this->activityScheduleRepo->create($activitySchedule);
        $createdActivitySchedule = $createdActivitySchedule->toArray();
        $this->assertArrayHasKey('id', $createdActivitySchedule);
        $this->assertNotNull($createdActivitySchedule['id'], 'Created ActivitySchedule must have id specified');
        $this->assertNotNull(ActivitySchedule::find($createdActivitySchedule['id']), 'ActivitySchedule with given id must be in DB');
        $this->assertModelData($activitySchedule, $createdActivitySchedule);
    }

    /**
     * @test read
     */
    public function testReadActivitySchedule()
    {
        $activitySchedule = $this->makeActivitySchedule();
        $dbActivitySchedule = $this->activityScheduleRepo->find($activitySchedule->id);
        $dbActivitySchedule = $dbActivitySchedule->toArray();
        $this->assertModelData($activitySchedule->toArray(), $dbActivitySchedule);
    }

    /**
     * @test update
     */
    public function testUpdateActivitySchedule()
    {
        $activitySchedule = $this->makeActivitySchedule();
        $fakeActivitySchedule = $this->fakeActivityScheduleData();
        $updatedActivitySchedule = $this->activityScheduleRepo->update($fakeActivitySchedule, $activitySchedule->id);
        $this->assertModelData($fakeActivitySchedule, $updatedActivitySchedule->toArray());
        $dbActivitySchedule = $this->activityScheduleRepo->find($activitySchedule->id);
        $this->assertModelData($fakeActivitySchedule, $dbActivitySchedule->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteActivitySchedule()
    {
        $activitySchedule = $this->makeActivitySchedule();
        $resp = $this->activityScheduleRepo->delete($activitySchedule->id);
        $this->assertTrue($resp);
        $this->assertNull(ActivitySchedule::find($activitySchedule->id), 'ActivitySchedule should not exist in DB');
    }
}
