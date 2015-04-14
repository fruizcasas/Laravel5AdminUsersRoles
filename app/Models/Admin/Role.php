<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\SortableTrait;


/**
 * Class Role
 *
 * @package App
 * @property integer $id 
 * @property string $name 
 * @property string $acronym 
 * @property string $display_name 
 * @property string $description 
 * @property \Carbon\Carbon $deleted_at 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin\User')->withTimestamps([] $users 
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin\Permission')->withTimestamps([] $permissions 
 * @property-read mixed $short_description 
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Role whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Role whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Role whereAcronym($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Role whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Role whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Role whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Role whereUpdatedAt($value)
 * @method static \App\Models\Admin\Role sortable($view)
 */
class Role extends Model {

    use SortableTrait;

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','display_name','acronym','description'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\Admin\User')->withTimestamps();
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Admin\Permission')->withTimestamps();
    }


    public function getShortDescriptionAttribute()
    {
        return str_limit($this->description,30);

    }

}

