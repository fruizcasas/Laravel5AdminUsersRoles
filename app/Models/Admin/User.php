<?php namespace App\Models\Admin;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Illuminate\Database\Eloquent\SoftDeletes;



use App\Models\Admin\Role;
use App\Traits\SortableTrait;

/**
 * App\Models\Admin\User
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin\Role')->withTimestamps([] $roles 
 * @property-read mixed $str_roles 
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin\Department')->withTimestamps([] $departments 
 * @property-read mixed $str_departments 
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\User whereAcronym($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\User whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\User whereComments($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\User whereIsAdmin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\User whereIsAuthor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\User whereIsReviewer($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\User whereIsApprover($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\User whereIsPublisher($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\User whereUpdatedAt($value)
 * @method static \App\Models\Admin\User sortable($view)
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
        'name',
        'acronym',
        'email',
        'display_name',
        'password',
        'comments',
        'is_admin',
        'is_employee',
        'is_author',
        'is_reviewer',
        'is_approver',
        'is_publisher',
    ];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    public function children()
    {
        return $this->hasMany('App\Models\Admin\ScUser','user_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Admin\SpUser','user_id');
    }

    /**
     * @return mixed
     */
    public function picture()
    {
        return $this->hasOne('App\Models\Admin\Picture');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Admin\Role')->withTimestamps();
    }

    public function folders()
    {
        return $this->hasMany('App\Models\Admin\Folder')->withTimestamps();
    }


    public function permissions()
    {
        $permissions = new Collection();
        foreach($this->roles as $role)
        {
            foreach($role->permissions as $permission)
            {
                if (! $permissions->contains('id',$permission->id))
                {
                    $permissions->add($permission);
                }
            }
        }
        return $permissions;
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
            $trim_roles[] = trim($role);
        }
        return implode(', ',$trim_roles);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function departments()
    {
        return $this->belongsToMany('App\Models\Admin\Department')->withTimestamps();
    }


    public function getStrDepartmentsAttribute()
    {
        $departments = $this->departments()->lists('acronym');
        $trim_departments = [];
        foreach($departments as $department)
        {
            $trim_departments[] = trim($department);
        }
        return implode(', ',$trim_departments);
    }

    static public function getUsers($id, $indent,$path)
    {
        $result = [];
        if ($indent<15) {
            $users = User::withTrashed()->whereUserId($id)->orderBy('name')->get();
            foreach ($users as $user) {
                $result[] = ['indent' => $indent, 'path' => $path.'.'.$user->name,'name' => $user->name, 'display_name' => $user->display_name, 'id' => $user->id, 'parent' => $id];
                $result = array_merge($result, static::GetUsers($user->id, $indent + 1,$path.'.'.$user->name));
            }
        }
        return $result;
    }

    static public function ListUsers($excluded = [])
    {
        $result = [];
        $result[User::ROOT_USER] = '*';
        $users = static::getUsers(User::ROOT_USER, 1,'*');
        foreach ($users as $user) {
            if (!in_array($user['id'], $excluded)) {
                $result[$user['id']] = $user['path'];
            }
        }
        return $result;
    }

    static protected $treeResult = '';

    static function treeUsers($route_show,$id, $indent,$name)
    {
        if ($indent<15) {
            $users = User::withTrashed()->whereUserId($id)->orderBy('name')->get();
            if ($users->count() > 0) {
                static::$treeResult .= PHP_EOL . '<ul>';
                foreach ($users as $user) {
                    static::$treeResult .= PHP_EOL . '<li>' . link_to_route($route_show,$user->name,['id'=> $user->id]) .' - '. ($user->trashed()?'<del>'.e($user->display_name).'</del>':e($user->display_name));
                    static::treeUsers($route_show,$user->id, $indent + 1, $user->name);
                    static::$treeResult .= PHP_EOL . '</li>';
                }
                static::$treeResult .= PHP_EOL . '</ul>';
            }
        }
    }
    static public function Tree($route_show)
    {
        static::$treeResult = '';
        static::treeUsers($route_show,User::ROOT_USER, 1,'*');
        return static::$treeResult;
    }



}
