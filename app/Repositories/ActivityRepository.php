<?php

namespace App\Repositories;

use App\Models\Activity;
use InfyOm\Generator\Common\BaseRepository;

class ActivityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'color',
        'icon',
        'is_selectable',
        'activity_type_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Activity::class;
    }
}
