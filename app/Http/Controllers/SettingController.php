<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Admin;
use App\Models\Course;
use App\Models\Faculty;
use App\Models\Reports;
use App\Models\Subject;
use App\Models\Curriculum;
use Illuminate\Http\Request;
use App\Imports\BackupImport;
use App\Models\AssignmentApprovals;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BackupExportMultiSheet;
use Illuminate\Support\Facades\Artisan;

class SettingController extends Controller
{

public function index()
    {
        $id = session()->get('LoggedUser');
        $user = User::where('id', $id)->first();
        $username = $user->username;

        if(!$id || !$user){
            $id = null;
            $user = null;
            $username = null;
        }

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

    public function backup()
    {
        return Excel::download(new BackupExportMultiSheet, 'backup.xlsx');
    }

    public function restore(Request $request)
    {
        if(!$request->file('import-file')){
            $id = session()->get('LoggedUser');
            $user = User::where('id', $id)->first();
            $username = $user->username;

            if(!$id || !$user){
                $id = null;
                $user = null;
                $username = null;
            }

            return view('settings', ['id' => $id, 'username' => $username]);
        }

        Artisan::call('migrate:refresh');

        Excel::import(new BackupImport(), $request->file('import-file'));

        $users = User::count();
        $courses = Course::count();
        $curricula = Curriculum::count();
        $subjects = Subject::count();
        $approvals = AssignmentApprovals::where('approval', 'Pending')
                                        ->count();
        $reports = Reports::count();

        return view('dashboard', compact('users', 'courses', 'curricula', 'subjects', 'approvals', 'reports'));
    }

    public function nuke()
    {
        Artisan::call('migrate:refresh');

        User::create([
            'fname' => "Admin",
            'username' => "admin1",
            'role' => "Admin",
            'password' => Hash::make('admin1'),           
        ]);

        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect()->route('auth.login');
        }else{
            return redirect()->route('auth.login');
        }
    }
}

