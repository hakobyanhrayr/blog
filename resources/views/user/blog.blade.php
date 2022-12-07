@extends('user.app')

@section('bg-img', asset('user/img/home-bg.jpg'))
@section('title','BitFumes Blog')
@section('sub-heading','Learn Together and Grow Together')

@section('head')
    <style>
        .fa-thumbs-up:hover{
            color:red;
        }
    </style>
@endsection

@section('main-content')
    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center" id="app">
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
                        <div style="display: flex;justify-content: space-between;align-items: center;margin-bottom: 15px">
                            <div>
                                <span>Status:{{ $post->status }}</span>
                            </div>
                            <div style="padding-bottom: 10px; display: flex;align-items: center;width: 100px;justify-content: space-between">
                                {{--                         @dd($likes);--}}

                                <small>Like: {{ $likes }} </small>
{{--                                @dd($user);--}}
                                <form action="{{route('like.index')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="post" value="{{ $post->id }}">
                                    <button type="submit" href="" id="#" data-id="{{ $post->id }}"  style="background: none;border: none"><i class="fa-solid fa-thumbs-up"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Pager-->
               <div class="d-flex justify-content-end">
                  {{ $posts->links() }}
               </div>
        </div>
    </div>
@endsection
@section('footer')
{{--    <script src="{{asset('js/app.js')}}"></script>--}}
@endsection
