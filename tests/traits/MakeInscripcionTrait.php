<?php

use Faker\Factory as Faker;
use App\Models\Inscripcion;
use App\Repositories\InscripcionRepository;

trait MakeInscripcionTrait
{
    /**
     * Create fake instance of Inscripcion and save it in database
     *
     * @param array $inscripcionFields
     * @return Inscripcion
     */
    public function makeInscripcion($inscripcionFields = [])
    {
        /** @var InscripcionRepository $inscripcionRepo */
        $inscripcionRepo = App::make(InscripcionRepository::class);
        $theme = $this->fakeInscripcionData($inscripcionFields);
        return $inscripcionRepo->create($theme);
    }

    /**
     * Get fake instance of Inscripcion
     *
     * @param array $inscripcionFields
     * @return Inscripcion
     */
    public function fakeInscripcion($inscripcionFields = [])
    {
        return new Inscripcion($this->fakeInscripcionData($inscripcionFields));
    }

    /**
     * Get fake data of Inscripcion
     *
     * @param array $postFields
     * @return array
     */
    public function fakeInscripcionData($inscripcionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'deposit_number' => $fake->word,
            'code' => $fake->word,
            'persona_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $inscripcionFields);
    }
}
