<?php

use Faker\Factory as Faker;
use App\Models\ActivitySchedule;
use App\Repositories\ActivityScheduleRepository;

trait MakeActivityScheduleTrait
{
    /**
     * Create fake instance of ActivitySchedule and save it in database
     *
     * @param array $activityScheduleFields
     * @return ActivitySchedule
     */
    public function makeActivitySchedule($activityScheduleFields = [])
    {
        /** @var ActivityScheduleRepository $activityScheduleRepo */
        $activityScheduleRepo = App::make(ActivityScheduleRepository::class);
        $theme = $this->fakeActivityScheduleData($activityScheduleFields);
        return $activityScheduleRepo->create($theme);
    }

    /**
     * Get fake instance of ActivitySchedule
     *
     * @param array $activityScheduleFields
     * @return ActivitySchedule
     */
    public function fakeActivitySchedule($activityScheduleFields = [])
    {
        return new ActivitySchedule($this->fakeActivityScheduleData($activityScheduleFields));
    }

    /**
     * Get fake data of ActivitySchedule
     *
     * @param array $postFields
     * @return array
     */
    public function fakeActivityScheduleData($activityScheduleFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'from' => $fake->word,
            'to' => $fake->word,
            'activity_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $activityScheduleFields);
    }
}
