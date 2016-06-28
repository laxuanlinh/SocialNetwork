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

        if(Auth::user()->uid===$user->uid)
        {
            return redirect()->route('home');
        }

        if(Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user()))
        {
            return redirect()->route('profile', ['username'=>$user->username])->with('info', 'Friend request already pending');
        }

        if(Auth::user()->isFriendWith($user))
        {
            return redirect()->route('profile', ['username'=>$user->username])->with('info', 'You are already friends');
        }
        Auth::user()->addFriend($user);
        return redirect()->route('profile', ['username'=>$user->username]);

    }

    public function getAccept($username)
    {
        $user=User::where('username', $username)->first();
        if(!$user)
        {
            return redirect()->route('home')->with('info', 'The user could not be found');
        }

        if(!Auth::user()->hasFriendRequestReceived($user))
        {
            return redirect()->route('home');
        }


        Auth::user()->acceptFriendRequest($user);
        return redirect()->route('profile', ['username'=>$user->username]);
    }

    public function postDelete($username)
    {
        $user=User::where('username', $username)->first();
        if(!Auth::user()->isFriendWith($user))
        {
            return redirect()->back();
        }
        Auth::user()->deleteFriend($user);
        return redirect()->back();
    }
}



















