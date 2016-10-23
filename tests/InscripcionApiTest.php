<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InscripcionApiTest extends TestCase
{
    use MakeInscripcionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateInscripcion()
    {
        $inscripcion = $this->fakeInscripcionData();
        $this->json('POST', '/api/v1/inscripcions', $inscripcion);

        $this->assertApiResponse($inscripcion);
    }

    /**
     * @test
     */
    public function testReadInscripcion()
    {
        $inscripcion = $this->makeInscripcion();
        $this->json('GET', '/api/v1/inscripcions/'.$inscripcion->id);

        $this->assertApiResponse($inscripcion->toArray());
    }

    /**
     * @test
     */
    public function testUpdateInscripcion()
    {
        $inscripcion = $this->makeInscripcion();
        $editedInscripcion = $this->fakeInscripcionData();

        $this->json('PUT', '/api/v1/inscripcions/'.$inscripcion->id, $editedInscripcion);

        $this->assertApiResponse($editedInscripcion);
    }

    /**
     * @test
     */
    public function testDeleteInscripcion()
    {
        $inscripcion = $this->makeInscripcion();
        $this->json('DELETE', '/api/v1/inscripcions/'.$inscripcion->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/inscripcions/'.$inscripcion->id);

        $this->assertResponseStatus(404);
    }
}
