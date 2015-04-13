<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use URL;
use Cookie;

class LocaleController extends Controller {

    public function setLocale($locale = 'en')
    {
        if (! in_array($locale,['en','es']))
        {
            $locale = 'en';
        }
        Cookie::queue('locale', $locale,120);
        return redirect(url(URL::previous()));
    }
}
