<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\SortableTrait;


/**
 * App\Models\Admin\Folder
 *
 * @property integer $id 
 * @property string $name 
 * @property integer $folder_id 
 * @property integer $user_id 
 * @property string $description 
 * @property \Carbon\Carbon $deleted_at 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Folder whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Folder whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Folder whereFolderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Folder whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Folder whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Folder whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Folder whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Folder whereUpdatedAt($value)
 * @method static \App\Models\Admin\Folder sortable($view)
 */
class Folder extends Model {

    use SortableTrait;

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'folders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description'];


}
