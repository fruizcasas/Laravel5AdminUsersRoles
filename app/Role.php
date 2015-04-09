<?php namespace App;

use Zizaco\Entrust\EntrustRole;

/**
 * Class Role
 * @package App
 */
class Role extends EntrustRole
{

    const ADMIN = 'admin';
    const AUTHOR = 'author';
    const REVIEWER = 'reviewer';
    const APPROVER = 'approver';
    const PUBLISHER = 'publisher';

}
