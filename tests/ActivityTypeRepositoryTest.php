<?php

use App\Models\ActivityType;
use App\Repositories\ActivityTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ActivityTypeRepositoryTest extends TestCase
{
    use MakeActivityTypeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ActivityTypeRepository
     */
    protected $activityTypeRepo;

    public function setUp()
    {
        parent::setUp();
        $this->activityTypeRepo = App::make(ActivityTypeRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateActivityType()
    {
        $activityType = $this->fakeActivityTypeData();
        $createdActivityType = $this->activityTypeRepo->create($activityType);
        $createdActivityType = $createdActivityType->toArray();
        $this->assertArrayHasKey('id', $createdActivityType);
        $this->assertNotNull($createdActivityType['id'], 'Created ActivityType must have id specified');
        $this->assertNotNull(ActivityType::find($createdActivityType['id']), 'ActivityType with given id must be in DB');
        $this->assertModelData($activityType, $createdActivityType);
    }

    /**
     * @test read
     */
    public function testReadActivityType()
    {
        $activityType = $this->makeActivityType();
        $dbActivityType = $this->activityTypeRepo->find($activityType->id);
        $dbActivityType = $dbActivityType->toArray();
        $this->assertModelData($activityType->toArray(), $dbActivityType);
    }

    /**
     * @test update
     */
    public function testUpdateActivityType()
    {
        $activityType = $this->makeActivityType();
        $fakeActivityType = $this->fakeActivityTypeData();
        $updatedActivityType = $this->activityTypeRepo->update($fakeActivityType, $activityType->id);
        $this->assertModelData($fakeActivityType, $updatedActivityType->toArray());
        $dbActivityType = $this->activityTypeRepo->find($activityType->id);
        $this->assertModelData($fakeActivityType, $dbActivityType->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteActivityType()
    {
        $activityType = $this->makeActivityType();
        $resp = $this->activityTypeRepo->delete($activityType->id);
        $this->assertTrue($resp);
        $this->assertNull(ActivityType::find($activityType->id), 'ActivityType should not exist in DB');
    }
}
