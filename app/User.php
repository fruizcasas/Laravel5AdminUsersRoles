<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Zizaco\Entrust\Traits\EntrustUserTrait;

use App\Role;
use App\Profile;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable;
    use CanResetPassword;
    use EntrustUserTrait;

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
    protected $fillable = ['name','display_name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    /**
     * @return mixed
     */
    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    public function getProfileAttribute()
    {
        $profile = $this->profile()->first();
        if (!$profile) {
            $profile = Profile::defaultRecord();
            $this->profile()->save($profile);
        }
        return $profile;
    }


}
