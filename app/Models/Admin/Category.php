<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\SortableTrait;

use App\Models\Admin\Category;



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
class Category extends Model {

    use SortableTrait;

    use SoftDeletes;
    protected $dates = ['deleted_at'];

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
    protected $fillable = ['name','acronym', 'display_name','description'];


    public function Path($glue = '/')
    {
        $result = $this->name;
        $category = $this;
        $count = 15;
        while (($category->category_id != null) && ($count))
        {
            $count--;
            $category = Category::find($category->category_id,'name');
            if ($category) {
                $result = $this->name . $glue . $result;
            };
        }
        return $result;
    }

}
