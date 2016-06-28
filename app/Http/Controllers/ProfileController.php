<?php
namespace Link\Http\Controllers;

Use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use Link\Models\User;
Use Link\Models\Status;
Use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function getProfile($username)
    {
        $user=User::where('username', $username)->first();
        if(!$user)
        {
            abort(404);
        }

        $statuses=$user->statuses()->notReply()->paginate(10);

        return view('profile.index')
            ->with('user', $user)
            ->with('statuses', $statuses)
            ->with('authIsFriendWith', Auth::user()->isFriendWith($user));
    }

    public function getEdit()
    {
        return view('profile.edit');
    }

    public function postEdit(Request $request)
    {
        $this->validate($request, [
           'firstname' => 'max:50',
           'lastname' => 'max:50',
            'location' => 'min:3'
        ]);
        Auth::user()->update([
           'firstname'=>$request['firstname'],
        'lastname'=>$request['lastname'],
        'location'=>$request['location']
        ]);
        return redirect()->route('profile.edit')->with('info', 'Your account has been updated')->with('user', Auth::user()->user);
    }
}