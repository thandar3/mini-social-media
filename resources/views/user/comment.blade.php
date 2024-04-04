@extends('layouts.master')

@section('title', 'CommentView Page')

@section('form')
    <link rel="stylesheet" href="{{ asset('admin/css/') }}">


    <a href="{{ route('user#home', $userData[0]['id']) }}">
        <i class="fa-solid fa-backward"></i> back
    </a>

    @if (session('commentSuccess'))
        <div class="alert alert-danger alert-dismissible fade show " role="alert">
            <strong>
                <i class="fa-solid fa-check"></i> {{ session('commentSuccess') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('user#addComment', $userData[0]['id']) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="" class="me-1">Caption: </label>
        <input class="mb-2 shadow-sm p-2 text-center" style="border: 1px solid white;" type="text"
            value="{{ $userData[0]['caption'] }}"><br>

        <img src="{{ asset('storage/' . $userData[0]['image']) }}" style="height: 300px" alt="cool photo">

        <input type="hidden" name="postId" value="{{ $userData[0]['id'] }}">

        <div class="mt-3">
            <label for="" class="mr-3">Give to Comment: </label>
            <input type="text" name="comment" placeholder="add to comment" class="shadow-sm">
        </div>

        <div class="mt-3">
            <label for="" class="mr-3">Give to React: </label>
            <input type="text" name="react" placeholder="1,2,3..." class="shadow-sm">
        </div>

        <input type="hidden" name="userName" value="{{ Auth::user()->name }}">



        <button class="btn btn-primary text-white" style="border-radius: 10px">add to commetn</button>


    </form>
@endsection
