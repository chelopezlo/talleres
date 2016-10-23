<?php

namespace App\Repositories;

use App\Models\Desposito;
use InfyOm\Generator\Common\BaseRepository;

class DespositoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'numeber',
        'date',
        'amount',
        'register_number',
        'used',
        'comments'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Desposito::class;
    }
}
