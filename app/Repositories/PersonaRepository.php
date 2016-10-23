<?php

namespace App\Repositories;

use App\Models\Persona;
use InfyOm\Generator\Common\BaseRepository;

class PersonaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'rut',
        'code',
        'full_name',
        'gender',
        'birthday',
        'occupation',
        'address',
        'phone',
        'email',
        'description',
        'facebook',
        'twitter',
        'users_id',
        'is_leader',
        'iglesias_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Persona::class;
    }
    
        /**
     * Find data by multiple fields
     *
     * @param array $where
     * @param array $columns
     *
     * @return mixed
     */
    public function findOrWhere(array $where, $columns = ['*'])
    {
        $this->applyCriteria();
        $this->applyScope();

        $this->applyConditionsOr($where);

        $model = $this->model->get($columns);
        $this->resetModel();

        return $this->parserResult($model);
    }
    
    protected function applyConditionsOr(array $where)
    {
        foreach ($where as $field => $value) {
            if (is_array($value)) {
                list($field, $condition, $val) = $value;
                $this->model = $this->model->orWhere($field, $condition, $val);
            } else {
                $this->model = $this->model->orWhere($field, '=', $value);
            }
        }
    }

}
