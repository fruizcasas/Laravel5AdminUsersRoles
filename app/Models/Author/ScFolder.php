<?php namespace App\Models\Author;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Author\ScFolder
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Author\Folder[] $children
 * @property-read \App\Models\Author\Folder $parent
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author\ScFolder whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author\ScFolder whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author\ScFolder whereFolderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author\ScFolder whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author\ScFolder whereRootId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author\ScFolder whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author\ScFolder whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author\ScFolder whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author\ScFolder whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author\ScFolder whereUpdatedAt($value)
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
        return $this->hasMany('App\Models\Author\Folder','folder_id');
    }


    public function parent()
    {
        return $this->belongsTo('App\Models\Author\Folder','folder_id');
    }


}
