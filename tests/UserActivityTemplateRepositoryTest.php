<?php

use App\Models\UserActivityTemplate;
use App\Repositories\UserActivityTemplateRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserActivityTemplateRepositoryTest extends TestCase
{
    use MakeUserActivityTemplateTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var UserActivityTemplateRepository
     */
    protected $userActivityTemplateRepo;

    public function setUp()
    {
        parent::setUp();
        $this->userActivityTemplateRepo = App::make(UserActivityTemplateRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateUserActivityTemplate()
    {
        $userActivityTemplate = $this->fakeUserActivityTemplateData();
        $createdUserActivityTemplate = $this->userActivityTemplateRepo->create($userActivityTemplate);
        $createdUserActivityTemplate = $createdUserActivityTemplate->toArray();
        $this->assertArrayHasKey('id', $createdUserActivityTemplate);
        $this->assertNotNull($createdUserActivityTemplate['id'], 'Created UserActivityTemplate must have id specified');
        $this->assertNotNull(UserActivityTemplate::find($createdUserActivityTemplate['id']), 'UserActivityTemplate with given id must be in DB');
        $this->assertModelData($userActivityTemplate, $createdUserActivityTemplate);
    }

    /**
     * @test read
     */
    public function testReadUserActivityTemplate()
    {
        $userActivityTemplate = $this->makeUserActivityTemplate();
        $dbUserActivityTemplate = $this->userActivityTemplateRepo->find($userActivityTemplate->id);
        $dbUserActivityTemplate = $dbUserActivityTemplate->toArray();
        $this->assertModelData($userActivityTemplate->toArray(), $dbUserActivityTemplate);
    }

    /**
     * @test update
     */
    public function testUpdateUserActivityTemplate()
    {
        $userActivityTemplate = $this->makeUserActivityTemplate();
        $fakeUserActivityTemplate = $this->fakeUserActivityTemplateData();
        $updatedUserActivityTemplate = $this->userActivityTemplateRepo->update($fakeUserActivityTemplate, $userActivityTemplate->id);
        $this->assertModelData($fakeUserActivityTemplate, $updatedUserActivityTemplate->toArray());
        $dbUserActivityTemplate = $this->userActivityTemplateRepo->find($userActivityTemplate->id);
        $this->assertModelData($fakeUserActivityTemplate, $dbUserActivityTemplate->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteUserActivityTemplate()
    {
        $userActivityTemplate = $this->makeUserActivityTemplate();
        $resp = $this->userActivityTemplateRepo->delete($userActivityTemplate->id);
        $this->assertTrue($resp);
        $this->assertNull(UserActivityTemplate::find($userActivityTemplate->id), 'UserActivityTemplate should not exist in DB');
    }
}
