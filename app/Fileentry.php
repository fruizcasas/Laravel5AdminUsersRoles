<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\SortableTrait;

class Fileentry extends Model {

    /* Get the post's author.
     *
     * @return User
     */
    public function uploader()
    {
        return $this->belongsTo('App\User');
    }

}
