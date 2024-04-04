<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use App\Models\UserPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //loginPage
    public function loginPage(){
        return view('login');
    }

    //registerPage
    public function registerPage(){
        return view('register');
    }

    //admin home
    public function admin(){
        return view('admin.homes');
    }

    public function user($id){
        $userData = UserPost::get();
        $userInfo = User::get();
        // dd($userInfo->toArray());
        $comment = Comment::get();
        $userName = User::select('users.*','user_posts.id as userPostId','user_posts.user_id as userId')->leftJoin('user_posts','users.id','user_posts.user_id')->get();
        // dd($userName->toArray());
        return view('user.home',compact('userData','comment','userInfo','userName'));
    }

   //dashboard
   public function dashboard(){
    return redirect()->route('user#home',Auth::user()->id);
    // if(Auth::user()->role == 'admin'){
    //     return redirect()->route('admin#home');
    // }else{}
   }

   public function searchData(Request $request){
    // dd($request->all());
    return redirect('home/{id}');
   }
}
