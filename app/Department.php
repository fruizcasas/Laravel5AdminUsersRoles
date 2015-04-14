<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Department
 *
 * @property integer $id 
 * @property string $name 
 * @property string $acronym 
 * @property string $display_name 
 * @property integer $department_id 
 * @property string $description 
 * @property string $deleted_at 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @method static \Illuminate\Database\Query\Builder|\App\Department whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Department whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Department whereAcronym($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Department whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Department whereDepartmentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Department whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Department whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Department whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Department whereUpdatedAt($value)
 */
class Department extends Model {

	//

}
