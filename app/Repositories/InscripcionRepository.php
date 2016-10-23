<?php

namespace App\Repositories;

use App\Models\Inscripcion;
use InfyOm\Generator\Common\BaseRepository;

class InscripcionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'deposit_number',
        'code',
        'persona_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Inscripcion::class;
    }
}
