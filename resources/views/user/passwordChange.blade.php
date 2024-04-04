@extends('layouts.master')

@section('title', 'Edit User Password')

<style>
    .edit {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 10px
    }
</style>

@section('form')
    <h3 class="text-muted edit">Edit About Password</h3>

    <a href="{{ route('user#viewInfo') }}" class="text-dark mb-2">
        <i class="fa-solid fa-arrow-left text-black"></i> back
    </a>

    @if (session('successPassEdit'))
        <div class="alert alert-success alert-dismissible fade show " role="alert">
            <strong>
                <i class="fa-solid fa-check"></i> {{ session('successPassEdit') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('not Match'))
        <div class="alert alert-danger alert-dismissible fade show " role="alert">
            <strong>
                {{ session('not Match') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('user#passwordData') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
        </div>
        @error('password')
            <p class="text-danger">{{ $message }}</p>
        @enderror

        <div class="form-group">
            <label>New Password</label>
            <input class="au-input au-input--full" type="password" name="newPassword" placeholder="New Password">
        </div>
        @error('newPassword')
            <p class="text-danger">{{ $message }}</p>
        @enderror

        <div class="form-group">
            <label> Comfirm Password</label>
            <input class="au-input au-input--full" type="password" name="password_confirmation"
                placeholder="Confirm Password">
        </div>
        @error('password_confirmation')
            <p class="text-danger">{{ $message }}</p>
        @enderror

        <button class="btn btn-primary" type="submit">Edit</button>
    </form>
@endsection
