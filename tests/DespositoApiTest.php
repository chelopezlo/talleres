<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DespositoApiTest extends TestCase
{
    use MakeDespositoTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateDesposito()
    {
        $desposito = $this->fakeDespositoData();
        $this->json('POST', '/api/v1/despositos', $desposito);

        $this->assertApiResponse($desposito);
    }

    /**
     * @test
     */
    public function testReadDesposito()
    {
        $desposito = $this->makeDesposito();
        $this->json('GET', '/api/v1/despositos/'.$desposito->id);

        $this->assertApiResponse($desposito->toArray());
    }

    /**
     * @test
     */
    public function testUpdateDesposito()
    {
        $desposito = $this->makeDesposito();
        $editedDesposito = $this->fakeDespositoData();

        $this->json('PUT', '/api/v1/despositos/'.$desposito->id, $editedDesposito);

        $this->assertApiResponse($editedDesposito);
    }

    /**
     * @test
     */
    public function testDeleteDesposito()
    {
        $desposito = $this->makeDesposito();
        $this->json('DELETE', '/api/v1/despositos/'.$desposito->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/despositos/'.$desposito->id);

        $this->assertResponseStatus(404);
    }
}
