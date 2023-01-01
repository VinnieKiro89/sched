<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('usermanage',['users'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $course = Course::create([
        //     'course_code'=>$request->course_code,
        //     'description'=>$request->description,
        // ]);

        // $course->assignRole($request->role);

        $this->validate($request,[
            'fname'=>'required',
            'username'=>'required|unique:users',
            'role'=>'required',
            'password'=>'required|min:5|max:8',
        ]);

        $user = new User;

        $user->fname = $request->fname;
        $user->username = $request->username;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);

        $user->save();
        
        if($request->role == 'Faculty'){
            return view('faculty.autoaddfaculty', ['fullname'=>$user->fname, 'user_id'=>$user->id]);
        }else{
            return redirect()->route('usermanage.index')->with('success', 'User Added Successfully.');
        }
    }

    /**
     * uh, for adding faculty i guess, i dont know
     */
    public function storefaculty(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'undergraduate' => 'required',
            'graduate' => 'required',
            'post_graduate' => 'required',
            'professional_license' => 'required',
            'name_of_company' => 'required',
            'length_of_teaching' => 'required',
            'field' => 'required',
            'subj_taught' => 'required',
            'nature_of_appt' => 'required',
            'status' => 'required',
            'email' => 'required',
            'contact' => 'required',
        ]);

        $faculty = new Faculty();

        $faculty->user_id = $request->user_id;
        $faculty->name = $request->name;
        $faculty->undergraduate = $request->undergraduate;
        $faculty->graduate = $request->graduate;
        $faculty->post_graduate = $request->post_graduate;
        $faculty->professional_license = $request->professional_license;
        $faculty->name_of_company = $request->name_of_company;
        $faculty->length_of_teaching = $request->length_of_teaching;
        $faculty->field = $request->field;
        $faculty->subj_taught = $request->subj_taught;
        $faculty->nature_of_appt = $request->nature_of_appt;
        $faculty->status = $request->status;
        $faculty->email = $request->email;
        $faculty->contact = $request->contact;

        $faculty->save();
        
        return redirect()->route('usermanage.index')->with('success', 'User Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        User::where('id',$request->id)->update([
            'fname'=>$request->fname,
            'username'=>$request->username,
            'role'=>$request->role,
            'password'=>Hash::make($request->password),
        ]);

        // DB::table('model_has_roles')->where('model_id',$request->id)->delete();

        // $user = User::findorfail($request->id);
        // $course->assignRole($request->role);

        return redirect()->route('usermanage.index')->with('updated', 'Update Success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findorfail($id);
        // User::where('course_id',$id)->delete();
        $user->delete();
        
        return redirect()->route('usermanage.index')->with('deleted', 'User Deleted!');
    }
}
