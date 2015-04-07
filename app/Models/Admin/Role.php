<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\SortableTrait;


/**
 * Class Role
 * @package App
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

