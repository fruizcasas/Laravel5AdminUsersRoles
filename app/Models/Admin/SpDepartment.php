<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Admin\SpDepartment
 *
 * @property integer $id
 * @property string $name
 * @property string $acronym
 * @property string $display_name
 * @property integer $department_id
 * @property integer $order
 * @property string $description
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin\Department[] $children
 * @property-read \App\Models\Admin\Department $parent
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpDepartment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpDepartment whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpDepartment whereAcronym($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpDepartment whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpDepartment whereDepartmentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpDepartment whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpDepartment whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpDepartment whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpDepartment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpDepartment whereUpdatedAt($value)
 */
class SpDepartment extends Model {

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sp_departments';


    public function children()
    {
        return $this->hasMany('App\Models\Admin\Department','department_id');
    }


    public function parent()
    {
        return $this->belongsTo('App\Models\Admin\Department','department_id');
    }


}
