<?php namespace App\Models\Author;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\SortableTrait;

/**
 * App\Models\Author\User
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
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Author\Role')->withTimestamps([] $roles
 * @property-read mixed $str_roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Author\Department')->withTimestamps([] $departments
 * @property-read mixed $str_departments
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author\User whereAcronym($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author\User whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author\User whereComments($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author\User whereIsAdmin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author\User whereIsAuthor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author\User whereIsReviewer($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author\User whereIsApprover($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author\User whereIsPublisher($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author\User whereUpdatedAt($value)
 * @method static \App\Models\Author\User sortable($view)
 * @property integer $user_id
 * @property integer $order
 * @property boolean $is_employee
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Author\Folder')->withTimestamps([] $folders
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author\User whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author\User whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author\User whereIsEmployee($value)
 */
class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use SortableTrait;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    const ROOT_USER = 0;


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
	protected $fillable = [
    ];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    public function folders()
    {
        return $this->hasMany('App\Models\Author\Folder')->withTimestamps();
    }

}
