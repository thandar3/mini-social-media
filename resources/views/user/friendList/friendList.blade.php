@extends('layouts.master')

@section('title', 'Friend List')

@section('form')

    <a href="{{ route('user#home', Auth::user()->id) }}">
        <i class="fa-solid fa-arrow-left text-black"></i> back
    </a>

    <div class="col-6 offset-3 mt-3">
        <form action="{{ route('user#friendList') }}" method="GET">
            <div class="d-flex">
                <input type="text" name="key" class="form-control" placeholder="Search...">
                <button class="btn btn-dark" type="submit">
                    <i class="zmdi zmdi-search"></i>
                </button>
            </div>
        </form>
    </div>

    <div class="">
        @foreach ($friends as $friend)
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 mt-3">
                    @if ($friend->image == null)
                        @if ($friend->gender == 'male')
                            <img src="{{ asset('default_user-removebg-preview.png') }}"
                                style="width: 50px; height: 50px; border-radius: 50px" class="mt-2 me-2" alt="">
                        @else
                            <img src="{{ asset('userFemale.png') }}" class="mt-2 me-2"
                                style="width: 50px; height: 50px; border-radius: 50px" alt="">
                        @endif
                    @else
                        <img src="{{ asset('storage/' . $friend->image) }}" style="border-radius: 50%" width="50px"
                            height="50px" alt="real acc photo">
                    @endif
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3 mt-4">
                    <small>{{ $friend->name }}</small>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 mt-4">
                    <a href="{{ route('user#acc', ['user_id' => $friend->id]) }}">
                        <button class="btn btn-info" style="border-radius: 10px">view Acc</button>
                    </a>
                </div>
            </div>
        @endforeach
        <div>
            {{ $users->links() }}
        </div>
    </div>
@endsection
