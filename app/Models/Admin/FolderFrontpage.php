<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class FolderFrontpage extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
