<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Admin\ScFolder
 *
 * @property integer $id
 * @property string $name
 * @property integer $folder_id
 * @property integer $order
 * @property integer $root_id
 * @property integer $user_id
 * @property string $description
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin\Folder[] $children
 * @property-read \App\Models\Admin\Folder $parent
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScFolder whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScFolder whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScFolder whereFolderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScFolder whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScFolder whereRootId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScFolder whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScFolder whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScFolder whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScFolder whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScFolder whereUpdatedAt($value)
 */
class ScFolder extends Model {


    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sc_folders';


    public function children()
    {
        return $this->hasMany('App\Models\Admin\Folder','folder_id');
    }


    public function parent()
    {
        return $this->belongsTo('App\Models\Admin\Folder','folder_id');
    }


}
