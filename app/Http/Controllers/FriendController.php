<?php
namespace Link\Http\Controllers;

Use Auth;
Use Illuminate\Http\Request;
Use Link\Models\User;

class FriendController extends Controller
{
    public function getIndexPage()
    {
        $friends=Auth::user()->friends();
        $friendRequests=Auth::user()->friendRequests();
        return view('friends.index')->with('friends', $friends)->with('friendRequests', $friendRequests);
    }

    public function getAdd($username)
    {
        $user=User::where('username', $username)->first();
        if(!$user)
        {
            return redirect()->route('home')->with('info', 'The user could not be found');
        }
        if(Auth::user()->hasFriendRequestPending($user))
        {
            
        }
    }
}