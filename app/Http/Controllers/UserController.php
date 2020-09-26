<?php

namespace App\Http\Controllers;

use App\Charts\DashboardChart;
use App\Comment;
use App\Http\Requests\UsrUpdate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dashboard()
    {
        $chart = new DashboardChart;
        $days = $this->generateDateRange(Carbon::now()->subDays(30), Carbon::now());
        $comments = [];
        foreach ($days as $day)
        {
            $comments[] = Comment::whereDate('created_at', $day)->where('user_id', Auth::id())->count();
        }
        $chart->dataset('Comments', 'line', $comments);
        $chart->labels($days);

        return view ('user.dashboard',compact('chart'));

    }
    private function generateDateRange(Carbon $start_date, Carbon $end_date)
    {
        $dates =[];
        for ($date=$start_date; $date->lte($end_date); $date->addDay())
        {
            $dates[] = $date->format('Y-m-d');
        }
        return $dates;
    }
    public function comments ()
    {
        return view ('user.comments');
    }
    public function newComment(Request $request)
    {
        $comments = new comment();
        $comments->post_id = $request['post'];
        $comments->user_id =Auth::id();
        $comments->content = $request['comment'];
        $comments->save();
        return back();
    }
    public function deleteComment ($id)
    {
        $comment= Comment::where('id', $id)->where('user_id',Auth::id())->delete();
        if ($comment){
                $comment->delete();
        }
        return back ();
    }

    public function profile ()
    {
        return view ('user.profile');
    }
    public function ProfilePost (UsrUpdate $request)
    {
        $user=Auth::user();
        $user->name= $request ['name'];
        $user->email= $request ['email'];
        $user->save ();
        return back ();
    }
}
