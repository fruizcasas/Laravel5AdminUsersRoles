<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Admin\ScUser
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
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScUser whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScUser whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScUser whereAcronym($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScUser whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScUser whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScUser wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScUser whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScUser whereComments($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScUser whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScUser whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScUser whereIsAdmin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScUser whereIsEmployee($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScUser whereIsAuthor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScUser whereIsReviewer($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScUser whereIsApprover($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScUser whereIsPublisher($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScUser whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScUser whereUpdatedAt($value)
 */
class ScUser extends Model {

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sc_users';


    public function children()
    {
        return $this->hasMany('App\Models\Admin\User','user_id');
    }


    public function parent()
    {
        return $this->belongsTo('App\Models\Admin\User','user_id');
    }

}
