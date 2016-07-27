<?php
namespace Link\Http\Controllers;
Use Auth;
Use Link\Models\Status;
Use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::check())
        {
            $statuses=Status::notReply()->where(function($query){
               return $query->where('uid', Auth::user()->uid)
                   ->orWhereIn('uid', Auth::user()->friends()->lists('uid'));
            })->orderBy('created_at', 'desc')->paginate(3);
            if($request->ajax())
            {
                return Response::json($statuses);
            }
            return view('timeline.index')->with('statuses', $statuses);
        }

        return view('home');
    }
}