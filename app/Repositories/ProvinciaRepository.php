<?php

namespace App\Repositories;

use App\Models\Provincia;
use InfyOm\Generator\Common\BaseRepository;

class ProvinciaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Provincia::class;
    }
}
