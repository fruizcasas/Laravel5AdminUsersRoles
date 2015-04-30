<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Admin\SpUser
 *
 * @property integer $id
 * @property string $name
 * @property string $acronym
 * @property string $display_name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property string $comments
 * @property integer $user_id
 * @property integer $order
 * @property boolean $is_admin
 * @property boolean $is_employee
 * @property boolean $is_author
 * @property boolean $is_reviewer
 * @property boolean $is_approver
 * @property boolean $is_publisher
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin\User[] $children
 * @property-read \App\Models\Admin\User $parent
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpUser whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpUser whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpUser whereAcronym($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpUser whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpUser whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpUser wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpUser whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpUser whereComments($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpUser whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpUser whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpUser whereIsAdmin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpUser whereIsEmployee($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpUser whereIsAuthor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpUser whereIsReviewer($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpUser whereIsApprover($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpUser whereIsPublisher($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpUser whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpUser whereUpdatedAt($value)
 */
class SpUser extends Model {

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sp_users';


    public function children()
    {
        return $this->hasMany('App\Models\Admin\User','user_id');
    }


    public function parent()
    {
        return $this->belongsTo('App\Models\Admin\User','user_id');
    }


}
