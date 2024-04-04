@extends('layouts.master')

@section('title', 'View Detail')

@section('form')
    <div style="max-width: 660px">
        <div class="form-group">
            <label>Caption</label>
            <input class="au-input au-input--full" type="text" value="{{ $data->caption }}">
        </div>
        @error('name')
            <p class="text-danger">{{ $message }}</p>
        @enderror

        <div>
            <img src="{{ asset('storage/' . $data->image) }}" style="height: 200px; width: 250px" alt="">
        </div>
        <hr>
        <h3 class="text-center mb-2" style="color: rgb(62, 61, 61)">For Edit Post</h3>

        <form action="{{ route('user#editPost', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="productId" value="{{ $data->id }}">

            <div class="form-group">
                <label>Edit caption</label>
                <input class="au-input au-input--full mb-2" name="editedCaption" type="text"
                    value="{{ $data->caption }}">
            </div>

            <input class="au-input au-input--full" type="file" name="editedImage" placeholder="pls chose image">

            <div class="row">
                <button class="btn btn-primary mt-2 text-end col-4 offset-4"
                    style="width: 100px; border-radius: 10px;">edit</button>
            </div>
        </form>
    </div>


@endsection
