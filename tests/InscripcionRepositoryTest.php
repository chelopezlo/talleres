<?php

use App\Models\Inscripcion;
use App\Repositories\InscripcionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InscripcionRepositoryTest extends TestCase
{
    use MakeInscripcionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var InscripcionRepository
     */
    protected $inscripcionRepo;

    public function setUp()
    {
        parent::setUp();
        $this->inscripcionRepo = App::make(InscripcionRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateInscripcion()
    {
        $inscripcion = $this->fakeInscripcionData();
        $createdInscripcion = $this->inscripcionRepo->create($inscripcion);
        $createdInscripcion = $createdInscripcion->toArray();
        $this->assertArrayHasKey('id', $createdInscripcion);
        $this->assertNotNull($createdInscripcion['id'], 'Created Inscripcion must have id specified');
        $this->assertNotNull(Inscripcion::find($createdInscripcion['id']), 'Inscripcion with given id must be in DB');
        $this->assertModelData($inscripcion, $createdInscripcion);
    }

    /**
     * @test read
     */
    public function testReadInscripcion()
    {
        $inscripcion = $this->makeInscripcion();
        $dbInscripcion = $this->inscripcionRepo->find($inscripcion->id);
        $dbInscripcion = $dbInscripcion->toArray();
        $this->assertModelData($inscripcion->toArray(), $dbInscripcion);
    }

    /**
     * @test update
     */
    public function testUpdateInscripcion()
    {
        $inscripcion = $this->makeInscripcion();
        $fakeInscripcion = $this->fakeInscripcionData();
        $updatedInscripcion = $this->inscripcionRepo->update($fakeInscripcion, $inscripcion->id);
        $this->assertModelData($fakeInscripcion, $updatedInscripcion->toArray());
        $dbInscripcion = $this->inscripcionRepo->find($inscripcion->id);
        $this->assertModelData($fakeInscripcion, $dbInscripcion->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteInscripcion()
    {
        $inscripcion = $this->makeInscripcion();
        $resp = $this->inscripcionRepo->delete($inscripcion->id);
        $this->assertTrue($resp);
        $this->assertNull(Inscripcion::find($inscripcion->id), 'Inscripcion should not exist in DB');
    }
}
