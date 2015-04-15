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
        $category = $this;
        while (($category->parent()->withTrashed()->count() > 0) && $count) {
            $count--;
            $category = $category->parent()->withTrashed()->first();
            $result =  $category->name . $glue . $result;
        }
        return $result;
    }

    public function children()
    {
        return $this->hasMany('App\Models\Admin\Category');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Admin\Category','category_id');
    }

    public function getShortDescriptionAttribute()
    {
        return str_limit($this->description, 30);

    }

    static public function getCategories($id, $indent,$path)
    {
        $result = [];
        if ($indent<15) {
            $categories = Category::withTrashed()->whereCategoryId($id)->get();
            foreach ($categories as $category) {
                $result[] = ['indent' => $indent, 'name' => $path.'.'.$category->name, 'id' => $category->id, 'parent' => $id];
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
                // $result[$category['id']] = str_repeat('-', $category['indent']) . $category['name'];
                $result[$category['id']] = $category['name'];
            }
        }
        return $result;
    }

}


