<?php

use Faker\Factory as Faker;
use App\Models\UserActivityTemplate;
use App\Repositories\UserActivityTemplateRepository;

trait MakeUserActivityTemplateTrait
{
    /**
     * Create fake instance of UserActivityTemplate and save it in database
     *
     * @param array $userActivityTemplateFields
     * @return UserActivityTemplate
     */
    public function makeUserActivityTemplate($userActivityTemplateFields = [])
    {
        /** @var UserActivityTemplateRepository $userActivityTemplateRepo */
        $userActivityTemplateRepo = App::make(UserActivityTemplateRepository::class);
        $theme = $this->fakeUserActivityTemplateData($userActivityTemplateFields);
        return $userActivityTemplateRepo->create($theme);
    }

    /**
     * Get fake instance of UserActivityTemplate
     *
     * @param array $userActivityTemplateFields
     * @return UserActivityTemplate
     */
    public function fakeUserActivityTemplate($userActivityTemplateFields = [])
    {
        return new UserActivityTemplate($this->fakeUserActivityTemplateData($userActivityTemplateFields));
    }

    /**
     * Get fake data of UserActivityTemplate
     *
     * @param array $postFields
     * @return array
     */
    public function fakeUserActivityTemplateData($userActivityTemplateFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'order' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $userActivityTemplateFields);
    }
}
