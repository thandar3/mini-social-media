@extends('layouts.master')

@section('title', 'addPostPage')

@section('form')
    <form action="{{ route('users#create') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Post Description</label>
            <input class="au-input au-input--full @error('description') is-invalid @enderror" type="text" name="description"
                value="{{ old('description') }}" placeholder="pls fill description...">
            @error('description')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>


        <div class="form-group">
            <label>Post Image</label>
            <input class="au-input au-input--full @error('image') is-invalid @enderror" type="file" name="image"
                placeholder="pls chose image">
            @error('image')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>



        <button class="btn btn-info" style="border-radius: 10px" type="submit">
            Review Post</button>
    </form>

    {{-- <a href="{{ route('user#viewPost', Auth::user()->id) }}" class="mt-3">
        <button class="btn btn-primary" style="border-radius: 10px">Review Post</button>
    </a> --}}

@endsection
