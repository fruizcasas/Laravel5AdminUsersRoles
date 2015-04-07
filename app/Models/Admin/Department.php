<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\SortableTrait;

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
    protected $fillable = ['name','display_name','description'];


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
