<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Activity",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="color",
 *          description="color",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="icon",
 *          description="icon",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="is_selectable",
 *          description="is_selectable",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="activity_type_id",
 *          description="activity_type_id",
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
class Activity extends Model
{
    use SoftDeletes;

    public $table = 'activities';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'description',
        'color',
        'icon',
        'is_selectable',
        'activity_type_id',
        'quota'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'color' => 'string',
        'icon' => 'string',
        'is_selectable' => 'integer',
        'activity_type_id' => 'integer',
        'quota' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function Persona() {
        return $this->belongsToMany('App\Models\Persona', 'user_activities')->with('ActivityType');
    }
    
    public function ActivityType() {
        return $this->belongsTo('App\Models\ActivityType');
    }
    
    public function ActivitySchedule() {
        return $this->hasMany('App\Models\ActivitySchedule');
    }
}
