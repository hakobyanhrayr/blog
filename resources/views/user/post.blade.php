@extends('user.app')

@section('bg-img', asset('user/img/post-bg.jpg'))
@section('title','BitFumes Post')
@section('sub-heading','Learn Together and Grow Together')


@section('main-content')
    <!-- Post Content-->
    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
             <div class="col-lg-6 m-auto" style="border: 1px solid black">
                 <h1>Title: {{ $post->title }}</h1>
                 <h3>SubTitle: {{ $post->subtitle }}</h3>
                 <p>Content: <br>{{ $post->body }}</p>
                 <span>Status:{{ $post->status }}</span>

             </div>
            </div>
        </div>
    </article>
@endsection
