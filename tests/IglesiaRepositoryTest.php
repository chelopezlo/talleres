<?php

use App\Models\Iglesia;
use App\Repositories\IglesiaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class IglesiaRepositoryTest extends TestCase
{
    use MakeIglesiaTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var IglesiaRepository
     */
    protected $iglesiaRepo;

    public function setUp()
    {
        parent::setUp();
        $this->iglesiaRepo = App::make(IglesiaRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateIglesia()
    {
        $iglesia = $this->fakeIglesiaData();
        $createdIglesia = $this->iglesiaRepo->create($iglesia);
        $createdIglesia = $createdIglesia->toArray();
        $this->assertArrayHasKey('id', $createdIglesia);
        $this->assertNotNull($createdIglesia['id'], 'Created Iglesia must have id specified');
        $this->assertNotNull(Iglesia::find($createdIglesia['id']), 'Iglesia with given id must be in DB');
        $this->assertModelData($iglesia, $createdIglesia);
    }

    /**
     * @test read
     */
    public function testReadIglesia()
    {
        $iglesia = $this->makeIglesia();
        $dbIglesia = $this->iglesiaRepo->find($iglesia->id);
        $dbIglesia = $dbIglesia->toArray();
        $this->assertModelData($iglesia->toArray(), $dbIglesia);
    }

    /**
     * @test update
     */
    public function testUpdateIglesia()
    {
        $iglesia = $this->makeIglesia();
        $fakeIglesia = $this->fakeIglesiaData();
        $updatedIglesia = $this->iglesiaRepo->update($fakeIglesia, $iglesia->id);
        $this->assertModelData($fakeIglesia, $updatedIglesia->toArray());
        $dbIglesia = $this->iglesiaRepo->find($iglesia->id);
        $this->assertModelData($fakeIglesia, $dbIglesia->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteIglesia()
    {
        $iglesia = $this->makeIglesia();
        $resp = $this->iglesiaRepo->delete($iglesia->id);
        $this->assertTrue($resp);
        $this->assertNull(Iglesia::find($iglesia->id), 'Iglesia should not exist in DB');
    }
}
