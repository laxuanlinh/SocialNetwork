<?php
namespace Link\Http\Controllers;

Use Auth;
Use Illuminate\Http\Request;
use Link\Models\Like;
Use Link\Models\Status;

class StatusController extends Controller
{
    public function postStatus(Request $request)
    {
        $this->validate($request, [
            'status'=>'required|max:2000'
        ]);
        Auth::user()->statuses()->create([
            'body'=>$request->input('status'),
        ]);
        return redirect()->route('home')->with('info', 'Your status has ben posted');
    }

    public function postReply(Request $request, $statusId)
    {
        $this->validate($request,[
            "reply-{$statusId}"=>"required|max:1000"
        ],[
            "required"=>"Body is required"
        ] );

        //don't know what this is, probably finding statuses which are not reply
        //don't ever use find() method as it always finds id column
        $status=Status::notReply()->where('sid', $statusId)->first();
        if(!$status)
        {
            return redirect()->route('home');
        }

        //check if the current user is friend with the status's user
        //and allow current user reply to its own status without being
        //friend to its own
        if(!Auth::user()->isFriendWith($status->user) && Auth::user()->uid !== $status->user->uid)
        {
            return redirect()->route('home');
        }

        //all checked, now create a reply
        $reply=Status::create([
           'body'=>$request->input("reply-{$statusId}")
        ])->user()->associate(Auth::user());
        $status->replies()->save($reply);

        return redirect()->back();
    }

    public function getLike($statusId)
    {
        $status=Status::find($statusId);
        if(!$status)
        {
            return redirect()->back();
        }

        if(Auth::user()->hasLikedStatus($status))
        {
            return redirect()->back();
        }

        $like=$status->likes()->create([]);
        Auth::user()->likes()->save($like);
        return redirect()->back();
    }

    public function getDislike($statusId)
    {
        $status=Status::find($statusId);
        if(!$status)
        {
            return redirect()->back();
        }

        $like=Like::where('likeable_id', $statusId)->where('uid', Auth::user()->uid)->first();
        if(!$like)
        {
            return redirect()->back();
        }
        $like->delete();
        return redirect()->back();
    }
}














