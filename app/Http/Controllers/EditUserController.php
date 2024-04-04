<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EditUserController extends Controller
{
    //user info view
    public function viewInfo(){
        $userInfo = User::where('id',Auth::user()->id)->first();
        return view('user.userInfo',compact('userInfo'));
    }

    //use info edit
    public function editInfo(){
        $userInfo = User::where('id',Auth::user()->id)->first();
        $user = User::where('id',Auth::user()->id)->first();
        return view('user.editInfo',compact('user','userInfo'));
    }

    //edit user info
    public function editUserInfo(Request $request,$id){
        $this->userInfoValidation($request);
        $data = $this->updateUserInfo($request);

        if($request->hasFile('image')){
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;
        }

        if($dbImage == null){
            Storage::delete('public/'.$dbImage);
        }

        $fileName = uniqid().$request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public',$fileName);
        $data['image'] =$fileName;
        User::where('id',$id)->update($data);
        $userData = User::where('id',Auth::user()->id)->first();
        return back()->with(['users' => $userData])->with(['editSuccess' => 'Your acc edited']);
    }

    //add data
    private function updateUserInfo($request){
        return [
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'gender' => $request->gender,
        ];
    }


    //validationCheck
    private function userInfoValidation($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|file',
            'gender' => 'required',
            'address' => 'required',
        ])->validate();
    }
}
