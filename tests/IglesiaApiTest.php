<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class IglesiaApiTest extends TestCase
{
    use MakeIglesiaTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateIglesia()
    {
        $iglesia = $this->fakeIglesiaData();
        $this->json('POST', '/api/v1/iglesias', $iglesia);

        $this->assertApiResponse($iglesia);
    }

    /**
     * @test
     */
    public function testReadIglesia()
    {
        $iglesia = $this->makeIglesia();
        $this->json('GET', '/api/v1/iglesias/'.$iglesia->id);

        $this->assertApiResponse($iglesia->toArray());
    }

    /**
     * @test
     */
    public function testUpdateIglesia()
    {
        $iglesia = $this->makeIglesia();
        $editedIglesia = $this->fakeIglesiaData();

        $this->json('PUT', '/api/v1/iglesias/'.$iglesia->id, $editedIglesia);

        $this->assertApiResponse($editedIglesia);
    }

    /**
     * @test
     */
    public function testDeleteIglesia()
    {
        $iglesia = $this->makeIglesia();
        $this->json('DELETE', '/api/v1/iglesias/'.$iglesia->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/iglesias/'.$iglesia->id);

        $this->assertResponseStatus(404);
    }
}
