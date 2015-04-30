<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/**
 * App\Models\Admin\DocumentFrontpage
 *
 */
class DocumentFrontpage extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
