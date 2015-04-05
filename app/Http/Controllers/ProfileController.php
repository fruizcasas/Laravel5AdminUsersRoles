<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

use App\Profile;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests\ProfileRequest;
use Route;


class ProfileController extends Controller
{

    public function edit()
    {
        $themes = Profile::THEMES();
        $model = Profile::loginProfile();
        return view('profiles.edit', compact(['model', 'themes']));
    }

    public function update(ProfileRequest $request)
    {
        $values = [];
        foreach ($request->rules() as $field => $rules) {
            $values[$field] = $request->input($field);
        }
        Profile::loginProfile()->update($values);
        flash()->info('The profile has been stored');
        return redirect(route('home'));
    }

    public function setTrash($route = 'home')
    {
        if (Auth::check()) {
            $profile = Profile::loginProfile();
            $profile->show_trash = 1;
            $profile->save();
            try {
                return redirect(route($route));
            } catch (Exception $e) {
                return redirect(route('home'));
            }
        } else {
            return redirect(url('/'));
        }

    }

    public function resetTrash($route = 'home')
    {
        if (Auth::check()) {
            $profile = Profile::loginProfile();
            $profile->show_trash = 0;
            $profile->save();
            try {
                return redirect(route($route));
            } catch (Exception $e) {
                return redirect(route('home'));
            }
        } else {
            return redirect(url('/'));
        }
    }


}
