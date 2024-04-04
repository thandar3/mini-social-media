@extends('layouts/master')

@section('title', 'LoginPage')

@section('form')
    <div class="login-form">
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Email Address</label>
                <input class="au-input au-input--full @error('email') is-invalid @enderror" type="email" name="email"
                    placeholder="Email">
            </div>


            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full @error('password') is-invalid @enderror" type="password"
                    name="password" placeholder="Password">
            </div>

            <button style="border-radius: 15px" class="au-btn au-btn--block au-btn--blue m-b-20" type="submit">sign
                in</button>

        </form>
        <div class="register-link">
            <p>
                Don't you have account?
                <a href="{{ route('auth#registerPage') }}" class="text-primary">Sign Up Here</a>
            </p>
        </div>
    </div>
@endsection
