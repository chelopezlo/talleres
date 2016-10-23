<?php

use Faker\Factory as Faker;
use App\Models\UserActivity;
use App\Repositories\UserActivityRepository;

trait MakeUserActivityTrait
{
    /**
     * Create fake instance of UserActivity and save it in database
     *
     * @param array $userActivityFields
     * @return UserActivity
     */
    public function makeUserActivity($userActivityFields = [])
    {
        /** @var UserActivityRepository $userActivityRepo */
        $userActivityRepo = App::make(UserActivityRepository::class);
        $theme = $this->fakeUserActivityData($userActivityFields);
        return $userActivityRepo->create($theme);
    }

    /**
     * Get fake instance of UserActivity
     *
     * @param array $userActivityFields
     * @return UserActivity
     */
    public function fakeUserActivity($userActivityFields = [])
    {
        return new UserActivity($this->fakeUserActivityData($userActivityFields));
    }

    /**
     * Get fake data of UserActivity
     *
     * @param array $postFields
     * @return array
     */
    public function fakeUserActivityData($userActivityFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'order' => $fake->randomDigitNotNull,
            'is_registered' => $fake->word,
            'registrarion_date' => $fake->word,
            'registrated_by' => $fake->word,
            'persona_id' => $fake->randomDigitNotNull,
            'activity_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $userActivityFields);
    }
}
