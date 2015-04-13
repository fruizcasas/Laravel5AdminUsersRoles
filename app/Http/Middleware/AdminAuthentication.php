<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;

class AdminAuthentication {

    protected $auth;
    public static $user;



    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


    public static function setUserAttribute($value)
    {
        if (! isset(AdminAuthentication::$user))
        {
            AdminAuthentication::$user =$value;
        }
    }
/**
 * Handle an incoming request.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \Closure  $next
 * @return mixed
 */

	public function handle($request, Closure $next)
	{
        if ($this->auth->check())
        {
            if (! isset(AdminAuthentication::$user ))
            {
                AdminAuthentication::$user =$this->auth->user();
            }
            if (AdminAuthentication::$user->is_admin == true)
            {
                return $next($request);
            }
        }
        return new RedirectResponse(url('/'));
	}

}
