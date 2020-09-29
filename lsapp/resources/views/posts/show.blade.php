@extends('layouts.app');

@section('content')
<a href="/posts" class="btn btn-default btn-secondary">Go back</a>
    <h1>{{$post->title}}</h1>
    <img style="width: 100%" src="/storage/cover_images/{{$post->cover_image}}" alt="">
    <div>
        {!!$post->body!!}
    </div>
    <hr>
    <small>Written on {{$post->created_at}} by {!! $post->user['name'] !!}</small>  {{-- Take post with relation to user and take that name--}}
    <hr>
    {{-- Check if the user is guest or no, loged or not --}}
    @if (!Auth::guest()) 
    {{-- Check if the user id is same with the post user id that are connected  --}}
        @if (Auth::user()->id == $post->user_id)            
            <a href="/posts/{{$post->id}}/edit" class="btn btn-warning">Edit</a>
            {!!Form::open(['action'=>['PostController@destroy', $post->id], 'method'=>'POST', 'class'=>'pull-right'])!!}
            {{Form::hidden('_method','DELETE')}}
            {{Form::submit('Delete',['class'=>'btn btn-danger '])}}
            {!!Form::close()!!}
        @endif
    @endif
@endsection