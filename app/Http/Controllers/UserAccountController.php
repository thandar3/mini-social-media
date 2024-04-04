<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserAccountController extends Controller
{
    //only one acc for one user
    public function account(Request $request){
        $images = UserPost::where('user_id',$request->user_id)->get();
        $user = User::where('id',$request->user_id)->first();
        $time = UserPost::where('user_id',$request->user_id)->first();
        return view('user.userAccount',compact('images','user','time'));
    }

    //friend list
    public function friendList(){
        $users =  User::when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%');
        })
        ->orderBy('id','desc')->paginate(3);
        $users->appends(request()->all());
        $friends = User::get();
        return view('user.friendList.friendList',compact('friends','users'));
    }

    //acc password edit
    public function editPass(){
        return view('user.passwordChange');
    }

    //password data
    public function passwordData(Request $request){
        $this->passwordValidation($request);

        $currentId = Auth::user()->id;
        $dbPassword = User::select('password')->where('id',$currentId)->first();
        $dbHashPassword = $dbPassword->password;

        if(Hash::check($request->password, $dbHashPassword)){
            $data = [
                'password' => Hash::make($request->newPassword)
            ];

            User::where('id',$currentId)->update($data);

            return back()->with(['successPassEdit' => 'Your Password Changed!']);
        }

        return back()->with(['not Match' => 'the old Password not Match! Try again']);


    }

    //validation for password
    private function passwordValidation($request){
        Validator::make($request->all(),[
            'password' => 'required',
            'newPassword' => 'required',
            'password_confirmation' => 'required|same:newPassword'
        ])->validate();
    }
}
