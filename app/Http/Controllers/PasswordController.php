<?php namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\PasswordRequest;
use App\Profile;
use Hash;
use Flash;

class PasswordController extends Controller {

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
		return view('password.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(PasswordRequest $request)
	{
        $user = Profile::loginProfile()->user;
        if (Hash::check($request->input('old_password'), $user->password))
        {
            // The passwords match...
            $user->password = bcrypt($request->input('password'));
            $user->save();
            Flash::info('Password Updated');
            return redirect(route('home'));
        }
        $errors = [];
        $errors['old_password'] = 'Invalid old password';
        return $request->response($errors);
    }

}
