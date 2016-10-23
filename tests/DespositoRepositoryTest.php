<?php

use App\Models\Desposito;
use App\Repositories\DespositoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DespositoRepositoryTest extends TestCase
{
    use MakeDespositoTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var DespositoRepository
     */
    protected $despositoRepo;

    public function setUp()
    {
        parent::setUp();
        $this->despositoRepo = App::make(DespositoRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateDesposito()
    {
        $desposito = $this->fakeDespositoData();
        $createdDesposito = $this->despositoRepo->create($desposito);
        $createdDesposito = $createdDesposito->toArray();
        $this->assertArrayHasKey('id', $createdDesposito);
        $this->assertNotNull($createdDesposito['id'], 'Created Desposito must have id specified');
        $this->assertNotNull(Desposito::find($createdDesposito['id']), 'Desposito with given id must be in DB');
        $this->assertModelData($desposito, $createdDesposito);
    }

    /**
     * @test read
     */
    public function testReadDesposito()
    {
        $desposito = $this->makeDesposito();
        $dbDesposito = $this->despositoRepo->find($desposito->id);
        $dbDesposito = $dbDesposito->toArray();
        $this->assertModelData($desposito->toArray(), $dbDesposito);
    }

    /**
     * @test update
     */
    public function testUpdateDesposito()
    {
        $desposito = $this->makeDesposito();
        $fakeDesposito = $this->fakeDespositoData();
        $updatedDesposito = $this->despositoRepo->update($fakeDesposito, $desposito->id);
        $this->assertModelData($fakeDesposito, $updatedDesposito->toArray());
        $dbDesposito = $this->despositoRepo->find($desposito->id);
        $this->assertModelData($fakeDesposito, $dbDesposito->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteDesposito()
    {
        $desposito = $this->makeDesposito();
        $resp = $this->despositoRepo->delete($desposito->id);
        $this->assertTrue($resp);
        $this->assertNull(Desposito::find($desposito->id), 'Desposito should not exist in DB');
    }
}
