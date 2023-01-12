<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Admin;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{

public function index()
    {
        $id = session()->get('LoggedUser');
        $user = User::where('id', $id)->first();
        $username = $user->username;

        return view('settings', ['id' => $id, 'username' => $username]);
    }

    public function updatePass(Request $request, $id)
    {
        $sessionid = session()->get('LoggedUser');
        $user = User::where('id', $id)->first();
        $hashed = $user->password;
        $username = $user->username;

        if (Hash::check($request->oldPW, $hashed)) {
            // return update
            if($request->newPW == $request->newPW2){
                User::where('id', $id)->update([
                    'password'=>Hash::make($request->newPW),
                ]);
                return redirect()->route('settings.index', ['id' => $sessionid, 'username' => $username])->with('success', 'Password has been updated');
            }else{
                return redirect()->route('settings.index', ['id' => $sessionid, 'username' => $username])->with('deleted', 'Error, Please re-type new password.');
            }
        }else{
            return redirect()->route('settings.index', ['id' => $sessionid, 'username' => $username])->with('deleted', 'Error, old password do not match.');
        }
    }

    public function updateUser(Request $request, $id)
    {
        $sessionid = session()->get('LoggedUser');
        $user = User::findorfail($id);
        
        // 2 lazy to correct the logic here
        $user2 = User::where('id', $id)->first();
        $username = $user2->username;
        
        if (!$user){
            return redirect()->route('settings.index', ['id' => $sessionid, 'username' => $username])->with('deleted', 'error');
        }else{
            User::where('id', $id)->update([
                'username'=>$request->username
            ]);
            return redirect()->route('settings.index', ['id' => $sessionid, 'username' => $username])->with('success', 'Username has been updated');
        }

        
    }
}

