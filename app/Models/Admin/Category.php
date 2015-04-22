<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\SortableTrait;
use App\Library\Utils;


/**
 * App\Models\Admin\Category
 *
 * @property integer $id
 * @property string $name
 * @property string $acronym
 * @property string $display_name
 * @property integer $category_id
 * @property string $description
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Category whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Category whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Category whereAcronym($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Category whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Category whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Category whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Category whereUpdatedAt($value)
 * @method static \App\Models\Admin\Category sortable($view)
 */

class Category extends Model
{

    use SortableTrait;

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    const ROOT_CATEGORY = 0;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'acronym', 'order', 'display_name'];



    public function children()
    {
        return $this->hasMany('App\Models\Admin\ScCategory','category_id')->withTrashed();
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Admin\SpCategory','category_id')->withTrashed();
    }

    public function Path($glue = '.')
    {
        $result =$this->name;
        $count = 15;
        $model = $this;
        while (($model->parent()->withTrashed()->count() > 0) && $count) {
            $count--;
            $model = $model->parent()->withTrashed()->first();
            $result =  $model->name . $glue . $result;
        }
        return $result;
    }

    public function getShortDescriptionAttribute()
    {
        return Utils::getplaintextintrofromhtml($this->description);
    }

    static public function getItems($id, $indent,$path)
    {
        $result = [];
        if ($indent<15) {
            $items = Category::withTrashed()->whereCategoryId($id)->orderBy('order')->orderBy('name')->get();
            foreach ($items as $item) {
                $result[] = ['indent' => $indent, 'path' => $path.'.'.$item->name,'name' => $item->name, 'display_name' => $item->display_name, 'id' => $item->id, 'parent' => $id];
                $result = array_merge($result, static::getItems($item->id, $indent + 1,$path.'.'.$item->name));
            }
        }
        return $result;
    }

    static public function ListItems($excluded = [])
    {
        $result = [];
        $result[Category::ROOT_CATEGORY] = '*';
        $items = static::getItems(Category::ROOT_CATEGORY, 1,'*');
        foreach ($items as $item) {
            if (!in_array($item['id'], $excluded)) {
                $result[$item['id']] = $item['path'];
            }
        }
        return $result;
    }

    static protected $treeResult = '';

    static function treeItems($route_show,$id, $indent,$name)
    {
        if ($indent<15) {
            $items = Category::withTrashed()->whereCategoryId($id)->orderBy('order')->orderBy('name')->get();
            if ($items->count() > 0) {
                static::$treeResult .= PHP_EOL . '<ul>';
                foreach ($items as $item) {
                    static::$treeResult .= PHP_EOL . '<li>' . link_to_route($route_show,$item->name,['id'=> $item->id]) .' - '
                                            .($item->trashed()?'<del>'.e($item->display_name).'</del>':e($item->display_name));
                    static::treeItems($route_show,$item->id, $indent + 1, $item->name);
                    static::$treeResult .= PHP_EOL . '</li>';
                }
                static::$treeResult .= PHP_EOL . '</ul>';
            }
        }
    }
    static public function Tree($route_show)
    {
        static::$treeResult = '';
        static::treeItems($route_show,Category::ROOT_CATEGORY, 1,'*');
        return static::$treeResult;
    }

}


