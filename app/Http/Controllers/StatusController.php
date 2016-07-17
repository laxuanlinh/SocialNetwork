<?php
namespace Link\Http\Controllers;

Use Auth;
Use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Link\Models\Like;
Use Link\Models\Status;

class StatusController extends Controller
{
    public function postStatus(Request $request)
    {
        if($request->ajax())
        {
            $this->validate($request, [
                'body'=>'required|max:2000'
            ]);
            $status=Status::create([
                'body'=>$request->input("body")
            ])->user()->associate(Auth::user());
            $status->save();
            return Response::json($status);
        }
        return Response::json(array('msg'=>'not done'), 400);
    }

    public function postReply(Request $request){
        $statusId=$request->input('sid');
        if($request->ajax()){
            $this->validate($request,[
                "body"=>"required|max:1000"
            ]);
            $status=Status::notReply()->where('sid', $statusId)->first();
            if(!$status)
            {
                return Response::json(array('msg'=>'status'), 400);
            }
            if(!Auth::user()->isFriendWith($status->user) && Auth::user()->uid !== $status->user->uid)
            {
                return Response::json(array('msg'=>'is not friend'), 400);
            }

            //all checked, now create a reply
            $reply=Status::create([
                'body'=>$request->input("body")
            ])->user()->associate(Auth::user());
            $status->replies()->save($reply);
            return Response::json($reply);
        }
    }

    public function getLike(Request $request)
    {

        if($request->ajax())
        {
            $statusId=$request->input('sid');
            $status=Status::find($statusId);
            //if status doesn't exist
            if(!$status)
            {
                return Response::json(array('msg'=>'status'), 400);
            }
            //if the user already liked it
            if(Auth::user()->hasLikedStatus($status))
            {
                return Response::json(array('msg'=>'status'), 400);
            }
            //no?
            $like=$status->likes()->create([]);
            Auth::user()->likes()->save($like);
            return Response::json($like);
        }
        return Response::json(array('msg'=>'status'), 400);
    }

    public function getDislike(Request $request)
    {
        if($request->ajax())
        {
            $statusId=$request->input('sid');
            $status=Status::find($statusId);
            if(!$status)
            {
                return Response::json(array('msg'=>'status'), 400);
            }

            $like=Like::where('sid', $statusId)->where('uid', Auth::user()->uid)->first();
            if(!$like)
            {
                return Response::json(array('msg'=>'status'), 400);
            }
            $like->delete();
            return Response::json($like);
        }
        return Response::json(array('msg'=>'status'), 400);
    }

   public function getLikeCount(Request $request)
   {
       $statusId=$request->input('sid');
       $status=Status::find($statusId);
       if(!$status)
       {
           return Response::json(array('msg'=>'status'), 400);
       }
       $count=$status->likes->count();
       return Response::json($count);
   }
}














