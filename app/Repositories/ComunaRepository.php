<?php

namespace App\Repositories;

use App\Models\Comuna;
use InfyOm\Generator\Common\BaseRepository;

class ComunaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'provincia_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Comuna::class;
    }
}
