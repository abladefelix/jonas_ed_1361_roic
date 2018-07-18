<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // for User Password
use DB;
use Auth;

class MLMSettingController extends Controller
{
    // get Settings of current User
	public function getUserSettings()
	{
		$userSettings = DB::table('users')->where('id', 2)->get();
    	return json_encode($userSettings);
	}

	// get Settings of current User -- if userId is passed
	public function getUserSettings2($userId)
	{
		$userSettings = DB::table('users')->where('id', Auth::user()->id)->get();
    	return json_encode($userSettings);
	}

	// update User Settings
	public function updateUserSettings(Request $request)
	{
		// array of details to be updated
		$updateDetails = array(
		    'firstname' => $request->get('firstname'),
		    'lastname'       => $request->get('lastname')
		);

		// Query Builder
		DB::table('users')->where('id', $request->get('id'))->update($updateDetails);

		//return response()->json(['success'=>'Data is successfully added']);
	}

	// check if Password entered is correct
	public function isPasswordEnteredCorrect($userId, $passwordEntered)
	{
		$user = DB::table('users')->where('id', $userId)->first();
		$hashedPassword = $user->password; // Hashed Password in record

		// Verifying the Password entered Against the Hashed Password
		if (Hash::check($passwordEntered, $hashedPassword))
			//return "true"; // The passwords match...
			$status = "true";
		else
			//return "false"; // The passwords don't match...
			$status = "false";

		// result array
    	$result = [
    		[
                'status' => $status
            ]
    	];

    	return json_encode($result);
	}

	// update User Password
	public function updateUserPassword(Request $request)
	{
		// array of details to be updated
		$updateDetails = array(
		    'password' => Hash::make($request->get('password')) // password is Hashed
		);

		// Query Builder
		DB::table('users')->where('id', $request->get('id'))->update($updateDetails);

		//return response()->json(['success'=>'Data is successfully added']);
		return "Password Updated!";
	}
}
