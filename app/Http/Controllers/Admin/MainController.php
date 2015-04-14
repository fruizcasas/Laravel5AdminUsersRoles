<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

/**
 * Class AdminController
 * @package App\Http\Controllers
 */
class MainController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.index');
	}

}
