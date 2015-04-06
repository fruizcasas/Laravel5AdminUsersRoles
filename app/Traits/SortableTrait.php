<?php namespace App\Traits;

use App\Profile;

trait SortableTrait
{
    public function scopeSortable($query,$view)
    {
        $order_by= Profile::loginProfile()->getOrderBy($view);
        if (is_array($order_by)) {
            foreach ($order_by as $column => $order) {
                $query = $query->orderBy($column,$order);
            }
        }
        return $query;
    }



    public static function link_to_sorting($route,$view,$col, $title = null, $attributes = [])
    {

        if (is_null($title)) {
            $title = str_replace('_', ' ', $col);
            $title = ucfirst($title);
        }
        $order_by= Profile::loginProfile()->getOrderBy($view);
        if (!is_array($order_by))
        {
            $order_by = [];
        }
        $indicator = (array_has($order_by,$col)? ($order_by[$col] === 'asc' ? '&darr;' : '&uarr;') : null);
        $parameters = [ $col , Profile::loginProfile()->getOrderByValue($view,$col)==='asc'?'desc':'asc' ];

        return link_to_route($route, "$title$indicator", $parameters,$attributes);
    }
}