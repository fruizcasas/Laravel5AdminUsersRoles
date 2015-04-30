<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Admin\ScDepartment
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
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScDepartment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScDepartment whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScDepartment whereAcronym($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScDepartment whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScDepartment whereDepartmentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScDepartment whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScDepartment whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScDepartment whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScDepartment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScDepartment whereUpdatedAt($value)
 */
class ScDepartment extends Model {

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sc_departments';


    public function children()
    {
        return $this->hasMany('App\Models\Admin\Department','department_id');
    }


    public function parent()
    {
        return $this->belongsTo('App\Models\Admin\Department','department_id');
    }


}
