@extends('layoutUser/master')

@section('title', 'UserHomePage')

<style>
    .icons {
        display: flex;
        justify-content: space-between;
    }

    .icons i #comment {
        font-size: 20px;
    }

    .icons #heart {
        color: white;
    }

    .icons #heart:hover {
        color: pink;
    }
</style>


@section('home')


    @if (session('postDelete'))
        <div class="alert alert-danger alert-dismissible fade show " role="alert">
            <strong>
                <i class="fa-solid fa-check"></i> {{ session('postDelete') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row font">
        <div class=" container mb-5 col-sm-12 col-md-6 col-lg-6">
            @foreach ($userData as $d)
                <div style="display: flex" class="mb-2">
                    @foreach ($userInfo as $info)
                        @if ($info->id == $d->user_id)
                            @if ($info->image !== null)
                                <img src="{{ asset('storage/' . $info->image) }}" style="border-radius: 50%;" width="50px"
                                    height="50px" alt="">
                            @elseif(Auth::user()->image == null)
                                <img src="{{ asset('userFemale.png') }}" style="border-radius: 50%;" width="50px"
                                    height="50px" alt="Male User" class="img-thumbnail ms-2" />
                            @endif
                        @endif
                    @endforeach
                </div>
                <p class="mb-3 p-4" style="background: white; width: 300px; border-radius:10px;">{{ $d->caption }}</p>

                <img src="{{ asset('storage/' . $d->image) }}" class="img-thumbnail"
                    style="width: 500px; height: 400px; border-radius: 10px" alt="User post image">

                <div class="mb-2">
                    <div>
                        @foreach ($comment as $c)
                            @if ($c->post_id == $d->id)
                                <div class="col-md-5 col-lg-5 col-sm-4 bg-light p-2 mt-3" style="border-radius: 10px">
                                    <div class="">
                                        <div style="display: flex;">
                                            @foreach ($userInfo as $info)
                                                @if ($info->id == $c->user_id)
                                                    @if ($info->image !== null)
                                                        <img src="{{ asset('storage/' . $info->image) }}"
                                                            style="border-radius: 50%;" width="50px" height="50px"
                                                            alt="">
                                                    @elseif(Auth::user()->image == null)
                                                        <img src="{{ asset('userFemale.png') }}" style="border-radius: 50%;"
                                                            width="50px" height="50px" alt="Male User"
                                                            class="img-thumbnail ms-2" />
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                        <i class="fa-solid fa-heart me-1 text-info"></i><span
                                            class="">{{ $c->react }}</span>
                                        likes
                                        <a href="{{ route('user#deleteComment', ['id' => $c->id, 'user_id' => $c->user_id]) }}"
                                            style="text-decoration: none">
                                            <i class="fa-solid fa-trash me-1"></i>Del
                                        </a>
                                        <h5>{{ $c->comment }}</h5>

                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                    <a href="{{ route('user#commentView', $d->id) }}" class="mt-2">
                        <button class="btn btn-primary post" type="submit">Give Comments--*</button>
                    </a>
                    <a href="{{ route('users#viewDetail', $d->id) }}" class="btn btn-primary text-dark ms-4  text-center ">
                        <button style="border-radius: 10px; width: 50px;" class="text-white">Edit Post</button>
                    </a>
                    {{-- <a href="{{ route('user#deletePost', ['user_id' => Auth::user()->id]) }}"
                        class="btn btn-primary text-dark ms-4  text-center ">
                        <button style="border-radius: 10px; width: 80px;" class="text-white">Delete Post</button>
                    </a> --}}
                </div>
            @endforeach
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h3 class="ms-1">Your's Friends <i class="fa-solid fa-heart text-danger"></i></h3>
            <div class="col-lg-6 mt-3">

                @foreach ($userInfo as $user)
                    <div class="row">
                        <div style="display: flex" class="col">
                            @if ($user->image == null)
                                <img src="{{ asset('userFemale.png') }}" class="mt-2"
                                    style="width: 100px; height: 100px; border-radius: 50px" alt="">
                            @else
                                <img src="{{ asset('storage/' . $user->image) }}" class="mt-2"
                                    style="width: 100px; height: 100px; border-radius: 50px" alt="">
                            @endif
                            <h5 class="mt-4 me-1">{{ $user->name }}</h5><br>
                            <span class="mt-4">
                                @if ($user->gender == 'male')
                                    @if ($user->id == Auth::user()->id)
                                        <small>(You)</small>
                                    @endif
                                    (<i class="fa-solid fa-mars text-dark mt-1"></i>)
                                @elseif ($user->gender == 'female')
                                    @if ($user->id == Auth::user()->id)
                                        <h5>you</h5>
                                    @endif
                                    (<i class="fa-solid fa-venus text-dark mt-1"></i>)
                                @endif
                            </span>
                            {{-- <div class="col mt-4">
                                @if ($user->id == Auth::user()->id)
                                    <button class="btn btn-primary float-end" style="display: none;">Follow</button>
                                @else
                                    <button class="btn btn-primary float-end" id="follow-btn"
                                        onclick="textChange()">Follow</button>
                                @endif

                                <script>
                                    function textChange() {
                                        document.getElementById('follow-btn').innerHTML = "Followed";
                                    }
                                </script>
                            </div> --}}
                        </div>

                    </div>
                @endforeach
            </div>
        </div>


    </div>


@endsection

{{-- jquery link  --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

{{-- @if ($d->user_id == Auth::user()->id)
    {{ Auth::user()->name }}
@elseif($d->user_id != Auth::user()->id)
    @foreach ($userName as $userNames)
        @if ($d->user_id != Auth::user()->name)
        @elseif($d->user_id == Auth::user()->id)
            {{ Auth::user()->name }}
        @endif
    @endforeach
@endif --}}
