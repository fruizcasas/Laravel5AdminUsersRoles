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


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\Admin\User')->withTimestamps();
    }


    public function getStrUsersAttribute()
    {
        $users = $this->roles()->lists('name');
        $trim_users = [];
        foreach($users as $user)
        {
            $trim_users[] = str_limit($user,3,'');
        }
        return implode(',',$trim_users);
    }

    public function getShortDescriptionAttribute()
    {
        return str_limit($this->description,30);

    }

}
