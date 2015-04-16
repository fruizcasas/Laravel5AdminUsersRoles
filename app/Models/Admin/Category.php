<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\SortableTrait;


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
    protected $fillable = ['name', 'acronym', 'display_name', 'description'];


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

    public function children()
    {
        return $this->hasMany('App\Models\Admin\ScCategory','category_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Admin\SpCategory','category_id');
    }

    public function getShortDescriptionAttribute()
    {
        return str_limit($this->description, 30);
    }

    static public function getCategories($id, $indent,$path)
    {
        $result = [];
        if ($indent<15) {
            $categories = Category::withTrashed()->whereCategoryId($id)->orderBy('name')->get();
            foreach ($categories as $category) {
                $result[] = ['indent' => $indent, 'path' => $path.'.'.$category->name,'name' => $category->name, 'display_name' => $category->display_name, 'id' => $category->id, 'parent' => $id];
                $result = array_merge($result, static::GetCategories($category->id, $indent + 1,$path.'.'.$category->name));
            }
        }
        return $result;
    }

    static public function ListCategories($excluded = [])
    {
        $result = [];
        $result[Category::ROOT_CATEGORY] = '*';
        $categories = static::getCategories(Category::ROOT_CATEGORY, 1,'*');
        foreach ($categories as $category) {
            if (!in_array($category['id'], $excluded)) {
                $result[$category['id']] = $category['path'];
            }
        }
        return $result;
    }

    static protected $treeResult = '';

    static function treeCategories($route_show,$id, $indent,$name)
    {
        if ($indent<15) {
            $categories = Category::withTrashed()->whereCategoryId($id)->orderBy('name')->get();
            if ($categories->count() > 0) {
                static::$treeResult .= PHP_EOL . '<ul>';
                foreach ($categories as $category) {
                    static::$treeResult .= PHP_EOL . '<li>' . link_to_route($route_show,$category->name,['id'=> $category->id]) .' - '. e($category->display_name);
                    static::treeCategories($route_show,$category->id, $indent + 1, $category->name);
                    static::$treeResult .= PHP_EOL . '</li>';
                }
                static::$treeResult .= PHP_EOL . '</ul>';
            }
        }
    }
    static public function Tree($route_show)
    {
        static::$treeResult = '';
        static::treeCategories($route_show,Category::ROOT_CATEGORY, 1,'*');
        return static::$treeResult;
    }

}


