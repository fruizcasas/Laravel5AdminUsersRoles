<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App;

class LocaleController extends Controller {

    public function setLocale($locale = 'en')
    {
        if (! in_array($locale,['en','es']))
        {
            $locale = 'en';
        }
        App::setlocale(session('locale',$locale));
        return redirect(route('home'));
    }
}
