<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Zizaco\Entrust\Traits\EntrustUserTrait;

use App\Role;
use App\Profile;

/**
 * App\User
 *
 * @property integer $id
 * @property string $name
 * @property string $acronym
 * @property string $display_name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property string $comments
 * @property boolean $is_admin
 * @property boolean $is_author
 * @property boolean $is_reviewer
 * @property boolean $is_approver
 * @property boolean $is_publisher
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Profile $profile
 * @property-read \Illuminate\Database\Eloquent\Collection|\Config::get('entrust.role')[] $roles
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereAcronym($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereComments($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereIsAdmin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereIsAuthor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereIsReviewer($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereIsApprover($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereIsPublisher($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @property integer $user_id
 * @property integer $order
 * @property boolean $is_employee
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereIsEmployee($value)
 */
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
    protected $fillable = ['name','display_name', 'email', 'password','comments'];

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
