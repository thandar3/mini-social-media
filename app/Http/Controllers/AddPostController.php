<?php

namespace App\Http\Controllers;

use App\Models\UserPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AddPostController extends Controller
{
    //userAddPost
    public function addPost(){
        return view('user.post');
    }

    //create page
    public function create(Request $request){
        $this->createPageValidation($request);
        $data = $this->addCreateData($request);

        $fileName = uniqid() . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public',$fileName);
        $data['image'] = $fileName;

        UserPost::create($data);
        return view('user.review',compact('data'));
    }


    //viewDetail
    public function viewDetail($id){
        $data = UserPost::where('id',$id)->first();
        return view('user.edit',compact('data'));
    }

    //comment View
    public function commentView($id){
        $userData =UserPost::where('id',$id)->get();
        // dd($userData->toArray());
        return view('user.comment',compact('userData'));
    }


    //createPageValidation
    private function createPageValidation($request){
        $validation = [
            'description' => 'required',
            'image' => 'mimes:png,jpg,jpeg|file',
        ];

        Validator::make($request->all(),$validation)->validate();
    }

    //add create data
    private function addCreateData($request){
        return  [
            'user_id' => Auth::user()->id,
            'caption' => $request->description,
        ];
    }
}
