<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="ActivitySchedule",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
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
class ActivitySchedule extends Model
{
    use SoftDeletes;

    public $table = 'activity_schedules';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'from',
        'to',
        'activity_id',
        'signed_up'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'from' => 'datetime',
        'to' => 'datetime',
        'activity_id' => 'integer',
        'signed_up' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function UserActivity() {
        return $this->hasMany('App\Models\UserActivity');
    }
    
        public function Activity() {
        return $this->belongsTo('App\Models\Activity');
    }
}
