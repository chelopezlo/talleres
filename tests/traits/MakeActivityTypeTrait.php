<?php

use Faker\Factory as Faker;
use App\Models\ActivityType;
use App\Repositories\ActivityTypeRepository;

trait MakeActivityTypeTrait
{
    /**
     * Create fake instance of ActivityType and save it in database
     *
     * @param array $activityTypeFields
     * @return ActivityType
     */
    public function makeActivityType($activityTypeFields = [])
    {
        /** @var ActivityTypeRepository $activityTypeRepo */
        $activityTypeRepo = App::make(ActivityTypeRepository::class);
        $theme = $this->fakeActivityTypeData($activityTypeFields);
        return $activityTypeRepo->create($theme);
    }

    /**
     * Get fake instance of ActivityType
     *
     * @param array $activityTypeFields
     * @return ActivityType
     */
    public function fakeActivityType($activityTypeFields = [])
    {
        return new ActivityType($this->fakeActivityTypeData($activityTypeFields));
    }

    /**
     * Get fake data of ActivityType
     *
     * @param array $postFields
     * @return array
     */
    public function fakeActivityTypeData($activityTypeFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'code' => $fake->word,
            'name' => $fake->word,
            'description' => $fake->text,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $activityTypeFields);
    }
}
