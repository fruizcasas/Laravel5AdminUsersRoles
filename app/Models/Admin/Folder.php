<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\SortableTrait;
use App\Library\Utils;


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
class Folder extends Model
{

    use SortableTrait;

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    const ROOT_FOLDER = 0;


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
    protected $fillable = ['name', 'order'];


    public function children()
    {
        return $this->hasMany('App\Models\Admin\ScFolder', 'folder_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Admin\SpFolder', 'folder_id');
    }

    /**
     * @return mixed
     */
    public function owner()
    {
        return $this->belongsTo('App\Models\Admin\User', 'user_id');
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

    public function getShortDescriptionAttribute()
    {
        return Utils::getplaintextintrofromhtml($this->description);
    }

    static public function getItems($id, $indent)
    {
        $result = [];
        if ($indent < 15) {
            $items = Folder::withTrashed()->whereFolderId($id)->orderBy('order')->orderBy('name')->get();
            foreach ($items as $item) {
                $result[] = ['indent' => $indent, 'path' => str_repeat('···+', $indent) . $item->name, 'name' => $item->name, 'id' => $item->id, 'parent' => $id];
                $result = array_merge($result, static::getItems($item->id, $indent + 1));
            }
        }
        return $result;
    }

    static public function ListItems($excluded = [])
    {
        $result = [];
        $result[Folder::ROOT_FOLDER] = '/';
        $items = static::getItems(Folder::ROOT_FOLDER, 0);
        foreach ($items as $item) {
            if (!in_array($item['id'], $excluded)) {
                $result[$item['id']] = $item['path'];
            }
        }
        return $result;
    }

    static protected $treeResult = '';

    static function treeItems($route_show, $id, $indent, array $params = [])
    {
        if ($indent < 15) {
            $items = Folder::withTrashed()->whereFolderId($id)->orderBy('order')->orderBy('name')->get();
            if ($items->count() > 0) {
                static::$treeResult .= PHP_EOL . '<ul>';
                foreach ($items as $item) {
                    if ($item->trashed()) {
                        static::$treeResult .= PHP_EOL . '<li><del>' . link_to_route($route_show, $item->name,
                                                array_merge(['id' => $item->id], $params)) . '</del>';
                    } else {
                        static::$treeResult .= PHP_EOL . '<li>' . link_to_route($route_show, $item->name,
                                                array_merge(['id' => $item->id], $params));
                    }
                    static::treeItems($route_show, $item->id, $indent + 1, $params);
                    static::$treeResult .= PHP_EOL . '</li>';
                }
                static::$treeResult .= PHP_EOL . '</ul>';
            }
        }
    }

    static public function Tree($route_show, $id = Folder::ROOT_FOLDER, array $params = [])
    {
        static::$treeResult = '';
        static::treeItems($route_show, $id, 1, $params);
        return static::$treeResult;
    }


}
