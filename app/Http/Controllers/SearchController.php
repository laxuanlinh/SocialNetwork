<?php
namespace Link\Http\Controllers;

Use Illuminate\Http\Request;
Use Link\Models\User;
Use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function getResults(Request $request)
    {
        if(!$request){
            return redirect()->route('home');
        }
        $users=User::where(DB::raw("CONCAT(firstname,' ', lastname)"), 'LIKE', "%{$request->input('query')}%")
                ->orWhere('username', 'LIKE', "%{$request->input('query')}%")
                ->get();
        return view('search.results')->with('users', $users);
    }
}