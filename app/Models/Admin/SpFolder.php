<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Admin\SpFolder
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
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpFolder whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpFolder whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpFolder whereFolderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpFolder whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpFolder whereRootId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpFolder whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpFolder whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpFolder whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpFolder whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpFolder whereUpdatedAt($value)
 */
class SpFolder extends Model {

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sp_folders';


    public function children()
    {
        return $this->hasMany('App\Models\Admin\Folder','folder_id');
    }


    public function parent()
    {
        return $this->belongsTo('App\Models\Admin\Folder','folder_id');
    }

    public function Path($glue = '/')
    {
        $result = $this->name;
        $count = 15;
        $model = $this;
        while (($model->parent()->withTrashed()->count() > 0) && $count) {
            $count--;
            $model = $model->parent()->withTrashed()->first();
            $result = $model->name . $glue . $result;
        }
        return $result;
    }



}
