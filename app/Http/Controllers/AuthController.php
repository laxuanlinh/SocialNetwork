<?php
namespace Link\Http\Controllers;

Use Illuminate\Http\Request;
Use Link\Models\User;
Use Auth;

class AuthController extends Controller
{
    public function getSignup()
    {
        return view('/auth/signup');
    }

    public function postSignUp(Request $request)
    {
        $this->validate($request, [
           'email'=> 'required|unique:users|email|max:50',
            'username' => 'required|unique:users|max:20|min:8',
            'password' => 'required|min:3',
        ]);
        User::create([
            'email'=>$request->input('email'),
            'username'=>$request->input('username'),
            'password'=>bcrypt($request->input('password'))
        ]);
        //return view('home')->with('info', 'You are now signed up');
        return redirect()->route('home')->with('info', 'You are now signed up');
    }

    public function getSignIn()
    {
        return view('/auth/signin');
    }

    public function postSignIn(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|max:20|min:8',
            'password' => 'required|min:3',
        ]);

        if(!Auth::attempt($request->only(['username', 'password']), $request->has('remember-me')))
        {
            return redirect()->back()->with('info', 'Could not sign in');
        }
        else
        {
            return redirect()->route('home')->with('info', 'You are now signed in');
        }
    }

    public function getSignOut()
    {
        Auth::logout();
        return redirect()->route('home')->with('info', 'You have logged out');
    }
}