<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\UserPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostEditController extends Controller
{
    //edit Post
    public function editPost(Request $request,$d){
        $this->validationCheck($request);
        $userPost = $this->createPostEdit($request);
        $imageFileName = uniqid().$request->file('editedImage')->getClientOriginalName();
        $request->file('editedImage')->storeAs('public/',$imageFileName);
        $userPost['image'] = $imageFileName;
        UserPost::where('id',$request->productId)->update($userPost);
        $userData = UserPost::get();
        return view('user.home',compact('userData'));
    }

    public function postDelete($id){
     Comment::where([
        ['id', '=', $id],
        ['user_id', '=', Auth::user()->id],
    ])->delete();
     return back();
    }

    private function validationCheck($request){
        $postValidation =[
            'editedCaption' => 'required',
            'editedImage' => 'required',
        ];

        Validator::make($request->all(),$postValidation)->validate();
    }

    private function createPostEdit($request){
        return [
            'caption' => $request->editedCaption,
        ];
    }
}
