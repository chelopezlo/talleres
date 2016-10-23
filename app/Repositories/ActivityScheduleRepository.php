<?php

namespace App\Repositories;

use App\Models\ActivitySchedule;
use InfyOm\Generator\Common\BaseRepository;

class ActivityScheduleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'from',
        'to',
        'activity_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ActivitySchedule::class;
    }
}
