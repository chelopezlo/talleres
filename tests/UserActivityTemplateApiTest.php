<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserActivityTemplateApiTest extends TestCase
{
    use MakeUserActivityTemplateTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateUserActivityTemplate()
    {
        $userActivityTemplate = $this->fakeUserActivityTemplateData();
        $this->json('POST', '/api/v1/userActivityTemplates', $userActivityTemplate);

        $this->assertApiResponse($userActivityTemplate);
    }

    /**
     * @test
     */
    public function testReadUserActivityTemplate()
    {
        $userActivityTemplate = $this->makeUserActivityTemplate();
        $this->json('GET', '/api/v1/userActivityTemplates/'.$userActivityTemplate->id);

        $this->assertApiResponse($userActivityTemplate->toArray());
    }

    /**
     * @test
     */
    public function testUpdateUserActivityTemplate()
    {
        $userActivityTemplate = $this->makeUserActivityTemplate();
        $editedUserActivityTemplate = $this->fakeUserActivityTemplateData();

        $this->json('PUT', '/api/v1/userActivityTemplates/'.$userActivityTemplate->id, $editedUserActivityTemplate);

        $this->assertApiResponse($editedUserActivityTemplate);
    }

    /**
     * @test
     */
    public function testDeleteUserActivityTemplate()
    {
        $userActivityTemplate = $this->makeUserActivityTemplate();
        $this->json('DELETE', '/api/v1/userActivityTemplates/'.$userActivityTemplate->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/userActivityTemplates/'.$userActivityTemplate->id);

        $this->assertResponseStatus(404);
    }
}
