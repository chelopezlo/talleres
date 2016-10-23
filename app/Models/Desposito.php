<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Desposito",
 *      required={"numeber", "amount"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="numeber",
 *          description="numeber",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="date",
 *          description="date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="amount",
 *          description="amount",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="register_number",
 *          description="register_number",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="used",
 *          description="used",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="comments",
 *          description="comments",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Desposito extends Model
{
    use SoftDeletes;

    public $table = 'despositos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'numeber',
        'date',
        'amount',
        'register_number',
        'used',
        'comments'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'numeber' => 'string',
        'date' => 'date',
        'amount' => 'integer',
        'register_number' => 'integer',
        'used' => 'integer',
        'comments' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'numeber' => 'required',
        'amount' => 'required'
    ];

    
}
