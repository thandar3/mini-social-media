<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AddPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EditUserController;
use App\Http\Controllers\PostEditController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\UserAccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


    Route::redirect('/', 'loginPage',);
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');


Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {

   Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

//    Route::group(['prefix' => 'admin','middleware'=>'admin_auth'],function(){
//     Route::get('home',[AuthController::class,'admin'])->name('admin#home');
//    });


   Route::group(['prefix' => 'user','middleware'=>'user_auth'],function(){
    Route::get('home/{id}',[AuthController::class,'user'])->name('user#home');
   });
});

Route::group(['prefix' => 'users'],function(){
    Route::get('addPost',[AddPostController::class,'addPost'])->name('users#addPost');
    Route::post('create',[AddPostController::class,'create'])->name('users#create');
   Route::get('viewDetail/{id}',[AddPostController::class,'viewDetail'])->name('users#viewDetail');
   Route::get('commentView/{id}',[AddPostController::class,'commentView'])->name('user#commentView');
   Route::post('addComment',[CommentController::class,'addComment'])->name('user#addComment');
   Route::post('editPost/{id}',[PostEditController::class,'editPost'])->name('user#editPost');
   Route::get('postDelete/{id}',[PostEditController::class,'postDelete'])->name('user#postDelete');
   Route::get('profile/change',[EditUserController::class,'viewInfo'])->name('user#viewInfo');
   Route::get('profile/edit',[EditUserController::class,'editInfo'])->name('user#editInfo');
   Route::post('profile/editUserInfo/{id}',[EditUserController::class,'editUserInfo'])->name('user#edituserinfo');
   Route::get('comment/delete/{id}/{user_id}',[CommentController::class,'deleteComment'])->name('user#deleteComment');
   Route::get('delete/post',[CommentController::class,'deletePost'])->name('user#deletePost');
   Route::get('search/data',[AuthController::class,'searchData'])->name('user#searchData');
   Route::get('account',[UserAccountController::class,'account'])->name('user#acc');
   Route::get('friend/list',[UserAccountController::class,'friendList'])->name('user#friendList');
   Route::get('user/comfirmPassword',[UserAccountController::class,'editPass'])->name('user#comfirmPassword');
   Route::post('pass/data',[UserAccountController::class,'passwordData'])->name('user#passwordData');

});
