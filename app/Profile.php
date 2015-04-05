<?php namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Profile extends Model
{
    /**
     *
     */
    const DEFAULT_THEME = 'spacelab';
    /**
     *
     */
    const DEFAULT_PER_PAGE= 15;
    /*
     *
     */
    const DEFAULT_SHOW_TRASH = false;


    /**
     * @return array
     */
    static public function THEMES()
    {
        $result = [];
        foreach ([
                     'cerulean',
                     'cosmo',
                     'cyborg',
                     'darkly',
                     'flatly',
                     'journal',
                     'lumen',
                     'paper',
                     'readable',
                     'sandstone',
                     'simplex',
                     'slate',
                     'spacelab',
                     'superhero',
                     'united',
                     'yeti',
                 ] as $theme) {
            $result[$theme] = Str::title($theme);
        }
        return $result;
    }


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['per_page', 'theme', 'show_trash','filters'];


    /**
     * @return Profile
     */
    static public function defaultRecord()
    {
        $profile = new Profile();
        $profile['per_page'] = Profile::DEFAULT_PER_PAGE;
        $profile['theme'] = Profile::DEFAULT_THEME;
        $profile['show_trash'] = Profile::DEFAULT_SHOW_TRASH;
        $profile['filters'] = '';
        return $profile;
    }

    static public function loginProfile()
    {
        static $login_profile = null;
        if (!isset($login_profile))
        {
            if (Auth::user()) {
                $login_profile = Auth::user()->profile()->first();
            }
        }
        return $login_profile;
    }


    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @param $view
     * @return array
     */
    public function getOrderBy($view)
    {
        $order_by = unserialize($this->order_by);
        $values=[];
        if (isset($order_by[$view])) {
            $values = $order_by[$view];
        }
        return $values;
    }

    /**
     * @param $view
     * @param $values
     */
    public function setOrderBy($view,$values)
    {
        $order_by = unserialize($this->order_by);
        $order_by[$view] = $values;
        $this->order_by = serialize($order_by);
        $this->update();
    }

    public static function OrderByLabel($view)
    {
        $result = [];
        $order_by= Profile::loginProfile()->getOrderBy($view);
        if (is_array($order_by)) {
            foreach ($order_by as $column => $order) {
                if ($column) {
                    $result[] = $column . (($order == 'desc') ? '(desc)' : '');
                }
            }
        }
        return implode(',',$result);
    }


    /**
     * @param $view
     * @param $column
     * @return string
     */
    public function getOrderByValue($view,$column)
    {
        $values=$this->getOrderBy($view);
        $value = "desc";
        if (array_has($values,$column)) {
            $value = $values[$column];
        }
        return $value;
    }

    /**
     * @param $view
     * @param $column
     * @param $value
     */
    public function setOrderByValue($view,$column,$value)
    {
        if (!isset($value))
        {
            $value='desc';
        }
        else if ($value !== 'asc')
        {
            $value='desc';
        }
        $values = $this->getOrderBy($view);
        $values[$column] = $value;
        $this->setOrderBy($view,$values);
    }



    /**
     * @param $view
     * @return array
     */
    public function getFilters($view)
    {
        $filters = unserialize($this->filters);
        $values=[];
        if (isset($filters[$view])) {
            $values = $filters[$view];
        }
        return $values;
    }

    /**
     * @param $view
     * @param $values
     */
    public function setFilters($view,$values)
    {
        $filters = unserialize($this->filters);
        $filters[$view] = $values;
        $this->filters = serialize($filters);
        $this->update();
    }

    public static function FilterByLabel($view)
    {
        $filters = Profile::loginProfile()->getFilters($view);
        $values = [];
        foreach ($filters as $key => $value)
        {
            if (trim($value) != '')
            {
                $values[] = "$key= $value";
            }
        }
        return implode(' | ',$values);
    }


    /**
     * @param $view
     * @param $field
     * @return string
     */
    public function getFilterValue($view,$field)
    {
        $values=$this->getFilters($view);
        $value = "";
        if (isset($values[$field])) {
            $value = $values[$field];
        }
        return $value;
    }

    /**
     * @param $view
     * @param $field
     * @param $value
     */
    public function setFilterValue($view,$field,$value)
    {
        $values = $this->getFilters($view);
        $values[$field] = $value;
        $this->setFilters($view,$values);
    }
}
