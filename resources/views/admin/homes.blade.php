@extends('layouts/master')

@section('title', 'AdminHomePage')

@section('form')
    <div>This is the Admin home page</div>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <input type="submit" value="logout">
    </form>
@endsection
