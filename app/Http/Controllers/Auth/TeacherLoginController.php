<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
//use Hash;
use Illuminate\Support\Facades\Hash;
class TeacherLoginController extends Controller
{
  public function __construct()
  {
    $this->middleware('guest:teacher', ['except' => ['logout']]);
  }

  public function showLoginForm()
  {
    return view('auth.teacher.login');
  }

  public function login(Request $request)
  {
    //Validate the form data
    $this->validate($request, [
      'nip'   => 'required',
      'password' => 'required'
    ]);

//    dd(Auth::guard('teacher')->attempt(['nip' => $request->nip, 'password' => $request->password,'active'=>1]));
    // Attempt to log the user in
    if (Auth::guard('teacher')->attempt(['nip' => $request->nip, 'password' => $request->password,'active'=>1])) {
      // if successful, then redirect to their intended location
      return redirect()->intended(route('teacher.dashboard'));
    }
    // if unsuccessful, then redirect back to the login with the form data
    return redirect()->back()->withInput($request->only('email', 'remember'));
    // dd($request);
    // $credentials = array(
    //   'nip' => $request->get('nip'),
    //   'password' => $request->get('password'),
    //   'active' => 1
    // );
    //
    // if (Auth::guard('teacher')->attempt($credentials)) {
    //   // Authentication passed...
    //   return redirect()->intended(route('teacher.dashboard'));
    // } else {
    //   return redirect('/login')->withInput($request->only('email', 'remember'))
    //   ->with('error', 'Invalid username or password or user already unactived.');
    // }

  }

  public function logout()
  {
    Auth::guard('teacher')->logout();
    return redirect('/teacher');
  }
}
