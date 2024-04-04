@extends('layouts.master')

@section('title', 'Edit User Info')

@section('form')

    <a href="{{ route('user#home', Auth::user()->id) }}" class="ms-2 mb-2">
        <i class="fa-solid fa-arrow-left text-dark"></i> <span class="text-dark">back</span>
    </a>

    @if (session('editSuccess'))
        <div class="alert alert-danger alert-dismissible fade show " role="alert">
            <strong>
                <i class="fa-solid fa-check"></i> {{ session('editSuccess') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('user#edituserinfo', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                @if ($user->image == null)
                    @if ($user->gender == 'male')
                        <img src="{{ asset('default_user.png') }}" alt="Male User" class="img-thumbnail ms-2" />
                    @else
                        <img src="{{ asset('userFemale.png') }}" alt="Female user" class="img-thumbnail ms-2" />
                    @endif
                @else
                    <img src="{{ asset('storage/' . $user->image) }}" style="border-radius: 50px; matgin-top: 15px"
                        width="200px" height="100px" alt="">
                @endif
                <input type="file" name="image">
                @error('image')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="">UserName</label>
                    <input type="text" class="p-2" name="name" style="border: 1px solid black; border-radius: 7px"
                        value="{{ $user->name }}">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="p-2" name="email" style="border: 1px solid black; border-radius: 7px"
                        value="{{ $user->email }}">
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Phone Num</label>
                    <input type="text" class="p-2" name="phone" style="border: 1px solid black; border-radius: 7px"
                        value="{{ $user->phone }}">
                    @error('phone')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <input type="text" class="p-2" name="address" style="border: 1px solid black; border-radius: 7px"
                        value="{{ $user->address }}">
                    @error('address')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="">Gender</label>
                    <select name="gender" class="form-control shadow-sm"
                        value="{{ old('gender', Auth::user()->gender) }}">
                        <option value="">Choose One Option</option>
                        <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                        <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female</option>
                    </select>
                    @error('gender')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-3 offset-4">
                <button type="submit" style="border-radius: 5px" class="btn btn-primary">Edit</button>
            </div>
        </div>
    </form>
@endsection
