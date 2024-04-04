<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use App\Models\UserPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
     //comment Add
     public function addComment(Request $request){
        $postId = $request->postId;
        $userName = $request->userName;
        $this->validationCommentCheck($request);
        $comment = $this->createComment($request);
        $userInfo = User::select('users.*','comments.comment as post_comment','comments.react as react')->leftJoin('comments','users.id','comments.user_id')->get();
        $commentInfo = UserPost::select('user_posts.*','comments.comment as user_comments','comments.react as user_reacts')->leftJoin('comments','user_posts.id','comments.post_id')->get();
       Comment::create($comment);
        return back()->with(['commentSuccess' => 'Your comment success added']);
    }

    //delete comment
    public function deleteComment($id,$user_id){
        Comment::where([
            ['id', '=', $id],
            ['user_id', '=', $user_id],
            ['user_id' , '=' ,Auth::user()->id]
        ])->delete();
        return back();
    }

    //delete post
    public function deletePost(Request $request){
        $data = UserPost::where('user_id',$request->user_id)->first();
        // $comment = Comment::where()
        $data->delete();
        return back()->with(['postDelete' => 'Your Post Delete Success']);
    }

    private function validationCommentCheck($request){
        Validator::make($request->all(),[
            'comment' => 'required',
            'react' => 'required'
        ])->validate();
    }

    private function createComment($request){
        $postId = $request->postId;
        return [
            'comment' => $request->comment,
            'react' => $request->react,
            'user_id' => Auth::user()->id,
            'post_id' => $postId
        ];
    }



}
