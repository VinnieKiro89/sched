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
        return view('settings', ['id' => $id]);
    }

    public function updatePass(Request $request, $id)
    {
        $sessionid = session()->get('LoggedUser');
        // TODO: check old password, then update Password
        $user = User::where('id', $id)->first();
        

        return view('settings', ['id' => $sessionid])->with('success', 'Password has been updated');
    }

    public function updateUser(Request $request, $id)
    {
        $sessionid = session()->get('LoggedUser');
        // TODO: update Username
        return view('settings', ['id' => $sessionid])->with('success', 'Username has been updated');
    }
}

