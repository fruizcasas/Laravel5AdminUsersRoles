<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Admin\PermissionRole
 *
 */
class PermissionRole extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at'];


}
