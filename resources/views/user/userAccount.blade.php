@extends('layouts.master')

@section('title', 'User Account')

@section('form')
    <div class="">
        <a href="{{ route('user#friendList') }}" class="ms-2 mb-2 text-dark">
            <i class="fa-solid fa-arrow-left text-dark"></i> <span class="text-dark">back</span>
        </a>
        <div class="row">
            <div class="d-flex mb-3 container col-lg-3 col-md-3 col-sm-3">
                @if ($user->image == null)
                    @if ($user->gender == 'male')
                        <img src="{{ asset('default_user-removebg-preview.png') }}"
                            style="width: 50px; height: 50px; border-radius: 50px" class="mt-2 me-2" alt="">
                    @else
                        <img src="{{ asset('userFemale.png') }}" class="mt-2 me-2"
                            style="width: 50px; height: 50px; border-radius: 50px" alt="">
                    @endif
                @else
                    <img src="{{ asset('storage/' . $user->image) }}" style="border-radius: 50%" width="50px"
                        height="50px" alt="real acc photo">
                @endif

                <h5 class=" ml-2" style="margin-top: 20px">{{ $user->name }}</h5>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 mt-2">
                @if ($user->id != request('user_id'))
                    <div>Have no post</div>
                @elseif($time == null)
                    <div>Have no post</div>
                @else
                    <small style="margin-left: 20px">{{ $time->created_at->diffForHumans() }}</small> <br>
                @endif
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
                <small style="margin-left: 20px">{{ count($images) }}</small> <br>
                <span>Posts</span>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3" id="button">
                <a href="{{ route('user#home', Auth::user()->id) }}">
                    <button class="btn btn-info" style="border-radius: 10px">Back to</button>
                </a>
            </div>



        </div>
        <div class="row">

            @foreach ($images as $image)
                <div class="col-md-4 col-md-offset-8 col-sm-4 col-lg-6 col-lg-offset-6">
                    <span> <img src="{{ asset('storage/' . $image->image) }}" width="100px" height="120px"
                            class="mb-2 mt-2" alt="post photo"></span>
                </div>
            @endforeach
        </div>


    </div>
@endsection
