<?php

namespace App\Repositories;

use App\Models\Iglesia;
use InfyOm\Generator\Common\BaseRepository;

class IglesiaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'pastor',
        'description',
        'phone',
        'comuna_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Iglesia::class;
    }
}
