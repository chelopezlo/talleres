<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Persona",
 *      required={"rut", "full_name"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="rut",
 *          description="rut",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="full_name",
 *          description="full_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="gender",
 *          description="gender",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="birthday",
 *          description="birthday",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="occupation",
 *          description="occupation",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="address",
 *          description="address",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="phone",
 *          description="phone",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="email",
 *          description="email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="facebook",
 *          description="facebook",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="twitter",
 *          description="twitter",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="users_id",
 *          description="users_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="is_leader",
 *          description="is_leader",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="iglesias_id",
 *          description="iglesias_id",
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
class Persona extends Model
{
    use SoftDeletes;

    public $table = 'personas';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'rut' => 'string',
        'code' => 'string',
        'full_name' => 'string',
        'gender' => 'integer',
        'birthday' => 'date',
        'occupation' => 'string',
        'address' => 'string',
        'phone' => 'string',
        'email' => 'string',
        'description' => 'string',
        'facebook' => 'string',
        'twitter' => 'string',
        'users_id' => 'integer',
        'is_leader' => 'integer',
        'iglesias_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'rut' => 'required',
        'full_name' => 'required',
        'email' => 'email',
        'users_id' => 'nullable',
        'iglesias_id' => 'nullable',
        'code' => 'nullable',
        'gender' => 'nullable',
        'birthday' => 'nullable',
        'occupation' => 'nullable',
        'address' => 'nullable',
        'phone' => 'nullable',
        'description' => 'nullable',
        'facebook' => 'nullable',
        'twitter' => 'nullable',
        'is_leader' => 'nullable',
    ];

    public function Activity() {
        return $this->belongsToMany('App\Models\Activity', 'user_activities')->withPivot('id', 'order', 'is_registered')->with('ActivityType');
    }
    
    public function ActivityType() {
        return $this->hasManyThrough('App\Models\ActivityType', 'App\Models\Activity');
    }
    
    public function Usuario() {
        return $this->belongsTo('App\User', 'users_id');
    }
}
