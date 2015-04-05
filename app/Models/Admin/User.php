<?php namespace App\Models\Admin;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Admin\Role;
use App\Traits\SortableTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use SortableTrait;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password','is_admin'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Admin\Role')->withTimestamps();
    }

    public function hasRole($value)
    {
        $role = Role::select('id')->where('name',$value);
        if ($role)
        {
            return $this->roles->contains($role);
        };
        return false;
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
