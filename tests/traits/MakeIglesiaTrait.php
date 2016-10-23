<?php

use Faker\Factory as Faker;
use App\Models\Iglesia;
use App\Repositories\IglesiaRepository;

trait MakeIglesiaTrait
{
    /**
     * Create fake instance of Iglesia and save it in database
     *
     * @param array $iglesiaFields
     * @return Iglesia
     */
    public function makeIglesia($iglesiaFields = [])
    {
        /** @var IglesiaRepository $iglesiaRepo */
        $iglesiaRepo = App::make(IglesiaRepository::class);
        $theme = $this->fakeIglesiaData($iglesiaFields);
        return $iglesiaRepo->create($theme);
    }

    /**
     * Get fake instance of Iglesia
     *
     * @param array $iglesiaFields
     * @return Iglesia
     */
    public function fakeIglesia($iglesiaFields = [])
    {
        return new Iglesia($this->fakeIglesiaData($iglesiaFields));
    }

    /**
     * Get fake data of Iglesia
     *
     * @param array $postFields
     * @return array
     */
    public function fakeIglesiaData($iglesiaFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'pastor' => $fake->word,
            'description' => $fake->text,
            'phone' => $fake->word,
            'comuna_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $iglesiaFields);
    }
}
