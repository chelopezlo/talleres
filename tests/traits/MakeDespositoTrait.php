<?php

use Faker\Factory as Faker;
use App\Models\Desposito;
use App\Repositories\DespositoRepository;

trait MakeDespositoTrait
{
    /**
     * Create fake instance of Desposito and save it in database
     *
     * @param array $despositoFields
     * @return Desposito
     */
    public function makeDesposito($despositoFields = [])
    {
        /** @var DespositoRepository $despositoRepo */
        $despositoRepo = App::make(DespositoRepository::class);
        $theme = $this->fakeDespositoData($despositoFields);
        return $despositoRepo->create($theme);
    }

    /**
     * Get fake instance of Desposito
     *
     * @param array $despositoFields
     * @return Desposito
     */
    public function fakeDesposito($despositoFields = [])
    {
        return new Desposito($this->fakeDespositoData($despositoFields));
    }

    /**
     * Get fake data of Desposito
     *
     * @param array $postFields
     * @return array
     */
    public function fakeDespositoData($despositoFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'numeber' => $fake->text,
            'date' => $fake->word,
            'amount' => $fake->randomDigitNotNull,
            'register_number' => $fake->randomDigitNotNull,
            'used' => $fake->randomDigitNotNull,
            'comments' => $fake->text,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $despositoFields);
    }
}
