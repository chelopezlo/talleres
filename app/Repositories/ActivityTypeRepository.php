<?php

namespace App\Repositories;

use App\Models\ActivityType;
use InfyOm\Generator\Common\BaseRepository;

class ActivityTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'name',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ActivityType::class;
    }
}
