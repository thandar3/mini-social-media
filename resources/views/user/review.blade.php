@extends('layouts.master')

@section('title', 'Review Post Page')

@section('form')
    <div>
        <h4 style=" justify-content: center; align-items: center; display: flex;">All about Post</h4>
        <hr>

        <div style=" justify-content: center; align-items: center; display: flex;" class="row">
            <div class="mt-3 col-7 offset-3">
                <input type="text" width="70px" style="padding: 15px" class="" value="{{ $data['caption'] }}">
            </div>

            <img height="60px" style="border-radius: 10px" width="200px" class="mb-3"
                src="{{ asset('storage/' . $data['image']) }}" alt="">
        </div>

        <form action="{{ route('user#home', Auth::user()->id) }}">
            <div style="margin-left: 170px">
                <button class="btn btn-primary">add to Post</button>
            </div>
        </form>
    </div>
@endsection
