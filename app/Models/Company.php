<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Company
 * @package App\Models
 * @version October 30, 2021, 3:58 pm UTC
 *
 * @property \App\Models\User $user
 * @property integer $user_id
 * @property string $name
 * @property string $zipCode
 * @property string $street
 * @property string $district
 * @property string $complement
 * @property string $city
 * @property string $state
 * @property integer $phone
 * @property integer $number_home
 */
class Company extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'companies';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'name',
        'zipCode',
        'street',
        'district',
        'complement',
        'city',
        'state',
        'phone',
        'number_home'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'name' => 'string',
        'zipCode' => 'string',
        'street' => 'string',
        'district' => 'string',
        'complement' => 'string',
        'city' => 'string',
        'state' => 'string',
        'phone' => 'string',
        'number_home' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'nullable',
        'name' => 'required|string|max:200',
        'zipCode' => 'required|string|max:9|min:9',
        'street' => 'required|string|max:255',
        'district' => 'required|string|max:255',
        'complement' => 'nullable|string|max:255',
        'city' => 'required|string|max:255',
        'state' => 'required|string|max:2',
        'phone' => 'required|string',
        'number_home' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function employees()
    {
        return $this->hasMany(\App\Models\Employee::class,'company_id');
    }
}
