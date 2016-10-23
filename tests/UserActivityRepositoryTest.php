<?php

use App\Models\UserActivity;
use App\Repositories\UserActivityRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserActivityRepositoryTest extends TestCase
{
    use MakeUserActivityTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var UserActivityRepository
     */
    protected $userActivityRepo;

    public function setUp()
    {
        parent::setUp();
        $this->userActivityRepo = App::make(UserActivityRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateUserActivity()
    {
        $userActivity = $this->fakeUserActivityData();
        $createdUserActivity = $this->userActivityRepo->create($userActivity);
        $createdUserActivity = $createdUserActivity->toArray();
        $this->assertArrayHasKey('id', $createdUserActivity);
        $this->assertNotNull($createdUserActivity['id'], 'Created UserActivity must have id specified');
        $this->assertNotNull(UserActivity::find($createdUserActivity['id']), 'UserActivity with given id must be in DB');
        $this->assertModelData($userActivity, $createdUserActivity);
    }

    /**
     * @test read
     */
    public function testReadUserActivity()
    {
        $userActivity = $this->makeUserActivity();
        $dbUserActivity = $this->userActivityRepo->find($userActivity->id);
        $dbUserActivity = $dbUserActivity->toArray();
        $this->assertModelData($userActivity->toArray(), $dbUserActivity);
    }

    /**
     * @test update
     */
    public function testUpdateUserActivity()
    {
        $userActivity = $this->makeUserActivity();
        $fakeUserActivity = $this->fakeUserActivityData();
        $updatedUserActivity = $this->userActivityRepo->update($fakeUserActivity, $userActivity->id);
        $this->assertModelData($fakeUserActivity, $updatedUserActivity->toArray());
        $dbUserActivity = $this->userActivityRepo->find($userActivity->id);
        $this->assertModelData($fakeUserActivity, $dbUserActivity->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteUserActivity()
    {
        $userActivity = $this->makeUserActivity();
        $resp = $this->userActivityRepo->delete($userActivity->id);
        $this->assertTrue($resp);
        $this->assertNull(UserActivity::find($userActivity->id), 'UserActivity should not exist in DB');
    }
}
