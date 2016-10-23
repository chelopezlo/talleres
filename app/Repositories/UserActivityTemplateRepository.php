<?php

namespace App\Repositories;

use App\Models\UserActivityTemplate;
use InfyOm\Generator\Common\BaseRepository;

class UserActivityTemplateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'order'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserActivityTemplate::class;
    }
}
