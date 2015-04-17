<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Config;
use URL;
use Cookie;

class LocaleController extends Controller {

    public function setLocale($locale = 'en')
    {
        $locales = Config::get('app.locales',['en' => 'English']);
        if (! array_has($locales,$locale))
        {
            $locale = 'en';
        }
        Cookie::queue('locale', $locale,120);
        return redirect(url(URL::previous()));
    }
}
