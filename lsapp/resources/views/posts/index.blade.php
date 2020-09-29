@extends('layouts.app');

@section('content')
<div class="container mt-5 ">
    <h1>Posts</h1>
    @if (count($posts)>0)
        @foreach ($posts as $post)
            <div class="well">
                <div class="row mt-5">
                    <div class="col-md-4 col-sm-4">
                        <img style="width: 100%" src="/storage/cover_images/{{$post->cover_image}}" alt="">
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-1"></div>
                    <div class="col-md-4 col-sm-4">
                        <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                        <small>Written on {{$post->created_at}} by {!!$post->user['name']!!}</small>
                    </div>
                </div>   
            </div>
        @endforeach  
        {{-- Create paginations --}}
        {{$posts->links()}}
    @else
      <p>No post found!!!</p>  
    @endif
</div>
@endsection