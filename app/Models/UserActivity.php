<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="UserActivity",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="order",
 *          description="order",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="is_registered",
 *          description="is_registered",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="registrarion_date",
 *          description="registrarion_date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="registrated_by",
 *          description="registrated_by",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="persona_id",
 *          description="persona_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="activity_id",
 *          description="activity_id",
 *          type="integer",
 *          format="int32"
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
class UserActivity extends Model
{
    use SoftDeletes;

    public $table = 'user_activities';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'order',
        'is_registered',
        'registrarion_date',
        'registrated_by',
        'persona_id',
        'activity_id',
        'activity_schedule_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'order' => 'integer',
        'is_registered' => 'integer',
        'registrarion_date' => 'date',
        'registrated_by' => 'string',
        'persona_id' => 'integer',
        'activity_id' => 'integer',
        'activity_schedule_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
   
//    public function Activity()
//    {
//        return $this->hasOne('App\Models\Activity');
//    }
    
    public function Persona() {
        return $this->belongsTo('App\Models\Persona');
    }
    
    public function Schedule() {
        return $this->belongsTo('App\Models\ActivitySchedule', 'activity_schedule_id');
    }
}
