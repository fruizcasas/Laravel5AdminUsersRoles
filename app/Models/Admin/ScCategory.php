<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Admin\ScCategory
 *
 * @property integer $id
 * @property string $name
 * @property string $acronym
 * @property string $display_name
 * @property integer $category_id
 * @property integer $order
 * @property string $description
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin\Category[] $children
 * @property-read \App\Models\Admin\Category $parent
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScCategory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScCategory whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScCategory whereAcronym($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScCategory whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScCategory whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScCategory whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScCategory whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ScCategory whereUpdatedAt($value)
 */
class ScCategory extends Model {

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sc_categories';


    public function children()
    {
        return $this->hasMany('App\Models\Admin\Category','category_id')->withTrashed();
    }


    public function parent()
    {
        return $this->belongsTo('App\Models\Admin\Category','category_id')->withTrashed();
    }


}
