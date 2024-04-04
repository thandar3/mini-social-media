@extends('layouts.master')

@section('title', 'User Info')

@section('form')

    <a href="{{ route('user#editInfo') }}" class="text-dark mb-2">
        <i class="fa-solid fa-arrow-left text-black"></i> back
    </a>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            @if (Auth::user()->image == null)
                @if (Auth::user()->gender == 'male')
                    <img src="{{ asset('default_user-removebg-preview.png') }}" alt="">
                @else
                    <img src="{{ asset('userFemale.png') }}" alt="">
                @endif
            @else
                <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="">
            @endif
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
                <label for="">UserName</label>
                <input type="text" class="p-2" style="border: 1px solid black; border-radius: 7px"
                    value="{{ $userInfo->name }}">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="p-2" style="border: 1px solid black; border-radius: 7px"
                    value="{{ $userInfo->email }}">
            </div>
            <div class="form-group">
                <label for="">Phone Num</label>
                <input type="text" class="p-2" style="border: 1px solid black; border-radius: 7px"
                    value="{{ $userInfo->phone }}">
            </div>
            <div class="form-group">
                <label for="">Address</label>
                <input type="text" class="p-2" style="border: 1px solid black; border-radius: 7px"
                    value="{{ $userInfo->address }}">
            </div>
            <div class="form-group">
                <label for="">Gender</label>
                <input type="text" class="p-2" style="border: 1px solid black; border-radius: 7px"
                    value="{{ $userInfo->gender }}">
            </div>
        </div>
    </div>
    <div class="">
        <a href="{{ route('user#editInfo') }}">
            <button>Edit Post</button>
    </div>
    </a>
@endsection
