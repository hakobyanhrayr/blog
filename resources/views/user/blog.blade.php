@extends('user.app')

@section('bg-img', asset('user/img/home-bg.jpg'))
@section('title','BitFumes Blog')
@section('sub-heading','Learn Together and Grow Together')

@section('main-content')
    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                @foreach($posts as $post)
{{--                    @dd($posts->toArray());--}}
                    <div class="post-preview">
                        <a href="{{route('posted.show', $post->id)}}">
                            <h2 class="post-title">
                                {{ $post->title }}
                            </h2>
                            <h3 class="post-subtitle">
                                {{ $post->subtitle }}
                            </h3>
                        </a>
                        <p class="post-meta">
                            Posted by
                            <a href="#!">Start Bootstrap</a>
                            {{ $post->created_at }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
