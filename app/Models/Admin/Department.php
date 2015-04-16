<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\SortableTrait;

/**
 * App\Models\Admin\Department
 *
 * @property integer $id 
 * @property string $name 
 * @property string $acronym 
 * @property string $display_name 
 * @property integer $department_id 
 * @property string $description 
 * @property \Carbon\Carbon $deleted_at 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin\User')->withTimestamps([] $users 
 * @property-read mixed $str_users 
 * @property-read mixed $short_description 
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Department whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Department whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Department whereAcronym($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Department whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Department whereDepartmentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Department whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Department whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Department whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Department whereUpdatedAt($value)
 * @method static \App\Models\Admin\Department sortable($view)
 */
class Department extends Model {

    use SortableTrait;

    use SoftDeletes;
    protected $dates = ['deleted_at'];


    const ROOT_DEPARTMENT = 0;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'departments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','acronym', 'display_name','description'];


    public function Path($glue = '.')
    {
        $result =$this->name;
        $count = 15;
        $model = $this;
        while (($model->parent()->withTrashed()->count() > 0) && $count) {
            $count--;
            $model = $model->parent()->withTrashed()->first();
            $result =  $model->name . $glue . $result;
        }
        return $result;
    }


    public function children()
    {
        return $this->hasMany('App\Models\Admin\ScDepartment','department_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Admin\SpDepartment','department_id');
    }


    public function getShortDescriptionAttribute()
    {
        return str_limit($this->description,30);

    }

    static public function getDepartments($id, $indent,$path)
    {
        $result = [];
        if ($indent<15) {
            $models = Department::withTrashed()->whereDepartmentId($id)->get();
            foreach ($models as $model) {
                $result[] = ['indent' => $indent, 'name' => $path.'.'.$model->name, 'id' => $model->id, 'parent' => $id];
                $result = array_merge($result, static::getDepartments($model->id, $indent + 1,$path.'.'.$model->name));
            }
        }
        return $result;
    }

    static public function ListDepartments($excluded = [])
    {
        $result = [];
        $result[Department::ROOT_DEPARTMENT] = '*';
        $models = static::getDepartments(Department::ROOT_DEPARTMENT, 1,'*');
        foreach ($models as $model) {
            if (!in_array($model['id'], $excluded)) {
                $result[$model['id']] = $model['name'];
            }
        }
        return $result;
    }



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\Admin\User')->withTimestamps();
    }


    public function getStrUsersAttribute()
    {
        $users = $this->users()->lists('acronym');
        $trim_users = [];
        foreach($users as $user)
        {
            $trim_users[] = trim($user);
        }
        return implode(', ',$trim_users);
    }


}
