<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Admin;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    function login(){
        return view('auth.login');
    }

    function register(){
        return view('auth.register');
    }

    function save(Request $request)
    {
        $request->validate([
            'fname'=>'required',
            'username'=>'required|unique:users',
            'role'=>'required',
            'password'=>'required|min:5|max:12',
        ]);

        $admin = new User;
        $admin->fname = $request->fname;
        $admin->username = $request->username;
        $admin->role = $request->role;
        $admin->password = Hash::make($request->password);
        $save = $admin->save();

        if($save){
            return view('auth.login')->with('success', 'New User added');
        }else{
            return back()->with('fail', 'Something went wrong, try again later');
        }
    }

    function check(Request $request){

        $request->validate([
            'username'=>'required',
            'password'=>'required|min:5|max:12',
        ]);

        $userauth = User::where('username','=', $request->username)->first();
        

        if(!$userauth){
            return back()->with('fail', 'Incorrect Username or Password');
        }else{
            if(Hash::check($request->password, $userauth->password)){
                
                $role = $userauth->role;
                $faculty = Faculty::where('user_id', $userauth->id)->first();
                
                $request->session()->put('Role', $role);
                $request->session()->put('LoggedUser', $userauth->id);

                
                if(session()->get('Role') == "Faculty") {
                    $request->session()->put('Faculty', $faculty->id);
                    return redirect()->route('reports.schedule', ['id' => $faculty->id]);
                }
                
                return redirect()->route('dashboard.index');

            }else{
                return back()->with('fail', 'Incorrect Username or Password');
            }
        }
    }

    function logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect()->route('auth.login');
        }
    }

}
