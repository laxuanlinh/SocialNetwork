<?php
namespace Link\Http\Controllers;
Use Auth;
Use Link\Models\Status;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::check())
        {
            $statuses=Status::notReply()->where(function($query){
               return $query->where('uid', Auth::user()->uid)
                   ->orWhereIn('uid', Auth::user()->friends()->lists('uid'));
            })->orderBy('created_at', 'desc')->paginate(10);

            return view('timeline.index')->with('statuses', $statuses);
        }

        return view('home');
    }
}