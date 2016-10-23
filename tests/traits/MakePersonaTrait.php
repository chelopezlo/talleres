<?php

use Faker\Factory as Faker;
use App\Models\Persona;
use App\Repositories\PersonaRepository;

trait MakePersonaTrait
{
    /**
     * Create fake instance of Persona and save it in database
     *
     * @param array $personaFields
     * @return Persona
     */
    public function makePersona($personaFields = [])
    {
        /** @var PersonaRepository $personaRepo */
        $personaRepo = App::make(PersonaRepository::class);
        $theme = $this->fakePersonaData($personaFields);
        return $personaRepo->create($theme);
    }

    /**
     * Get fake instance of Persona
     *
     * @param array $personaFields
     * @return Persona
     */
    public function fakePersona($personaFields = [])
    {
        return new Persona($this->fakePersonaData($personaFields));
    }

    /**
     * Get fake data of Persona
     *
     * @param array $postFields
     * @return array
     */
    public function fakePersonaData($personaFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'rut' => $fake->word,
            'full_name' => $fake->word,
            'gender' => $fake->word,
            'birthday' => $fake->word,
            'occupation' => $fake->word,
            'address' => $fake->word,
            'phone' => $fake->word,
            'email' => $fake->word,
            'description' => $fake->text,
            'facebook' => $fake->word,
            'twitter' => $fake->word,
            'users_id' => $fake->randomDigitNotNull,
            'is_leader' => $fake->word,
            'iglesias_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $personaFields);
    }
}
