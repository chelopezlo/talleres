<?php

namespace App\Repositories;

use App\Models\UserActivity;
use InfyOm\Generator\Common\BaseRepository;

class UserActivityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'order',
        'is_registered',
        'registrarion_date',
        'registrated_by',
        'persona_id',
        'activity_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserActivity::class;
    }
}
