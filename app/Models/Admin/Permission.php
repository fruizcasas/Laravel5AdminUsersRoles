<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\SortableTrait;


/**
 * App\Models\Admin\Permission
 *
 * @property integer $id 
 * @property string $name 
 * @property string $acronym 
 * @property string $display_name 
 * @property string $description 
 * @property \Carbon\Carbon $deleted_at 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin\Role')->withTimestamps([] $roles 
 * @property-read mixed $short_description 
 * @property-read mixed $str_roles 
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Permission whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Permission whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Permission whereAcronym($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Permission whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Permission whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Permission whereUpdatedAt($value)
 * @method static \App\Models\Admin\Permission sortable($view)
 */
class Permission extends Model {

    use SortableTrait;

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','display_name','description'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Admin\Role')->withTimestamps();
    }

    public function getShortDescriptionAttribute()
    {
        return str_limit($this->description,30);

    }

    public function getStrRolesAttribute()
    {
        $roles = $this->roles()->lists('acronym');
        $trim_roles = [];
        foreach($roles as $role)
        {
            $trim_roles[] = str_limit($role,3,'');
        }
        return implode(',',$trim_roles);
    }



}
