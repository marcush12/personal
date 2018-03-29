<?php

namespace App\Http\Controllers;

use App\Charts\DashboardChart;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\UserUpdate;
use App\Comment;
use Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $chart = new DashboardChart();
        $days = $this->generateDateRange(\Carbon\Carbon::now()->subDays(30), \Carbon\Carbon::now());
        $comments = [];
        foreach ($days as $day) {
            $comments[] = Comment::whereDate('created_at', $day)->where('user_id', Auth::id())->count();
        }
        $chart->dataset('Comments', 'line', $comments);
        $chart->labels($days);
        return view('user.dashboard', compact('chart'));
    }

    private function generateDateRange(\Carbon\Carbon $start_date, \Carbon\Carbon $end_date)
    {
        $dates = [];
        for($date = $start_date; $date->lte($end_date); $date->addDay()) {
            $dates[] = $date->format('Y-m-d');
        }
        return $dates;
    }

    public function comments()
    {
        return view('user.comments');
    }

    public function deleteComment($id)
    {
        //verificar se o current user é o autor do comentário
        $comment = Comment::where('id', $id)->where('user_id', Auth::id())->delete();
        return back();
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function profilePost(UserUpdate $request)
    {
        $user = Auth::user();

        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->save();

        if ($request['password'] != '') {
            if (!(Hash::check($request['password'], Auth::user()->password))) {
                return redirect()->back()->with('error', 'A senha digitada não confere com a fornecida para login');
            }
            if (strcmp($request['password'], $request['new_password']) == 0) {
                return redirect()->back()->with('error', 'A nova senha não pode ser igual à senha corrente.');
            }
            $validation = $request->validate([
                'password' => 'required',
                'new_password' => 'required|string|min:6|confirmed', //confirmed chech new_pass and new_pass_conf
            ]);
            $user->password = bcrypt($request['new_password']);
            $user->save();

            return redirect()->back()->with('success', 'Senha alterada com sucesso!');
        }

        return back();
    }

    public function newComment(Request $request)
    {
        $comment = new Comment;
        $comment->post_id = $request['post'];
        $comment->user_id = Auth::id();
        $comment->content = $request['comment'];
        $comment->save();

        return back();

    }
}
