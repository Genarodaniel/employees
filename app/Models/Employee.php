<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Employee
 * @package App\Models
 * @version October 30, 2021, 11:44 pm UTC
 *
 * @property \App\Models\Company $company
 * @property string $name
 * @property integer $company_id
 * @property string $position
 * @property number $wage
 */
class Employee extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'employees';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'company_id',
        'position',
        'wage'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'company_id' => 'integer',
        'position' => 'string',
        'wage' => 'decimal:2'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:200',
        'company_id' => 'nullable',
        'position' => 'required|string',
        'wage' => 'required|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class, 'company_id');
    }
}
