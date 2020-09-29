@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div>
                        <a href="/posts/create" class="btn btn-dark">Create Post</a>
                        <h3>Your Blog Posts</h3>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @else 
                     
                     {{ __('You are logged in!') }} 
                     @endif 
                   @if (count($posts)>0)
                     <table class="table table-striped">
                         <tr>
                             <th>Title</th>
                             <th></th>
                             <th></th>
                         </tr>
                         @foreach ($posts as $post)
                             <tr>
                                <th>{{$post->title}}</th>
                                <th><a href="/posts/{{$post->id}}/edit" class="btn btn-warning">Edit</a></th>
                                <th>
                                    {!!Form::open(['action'=>['PostController@destroy', $post->id], 'method'=>'POST', 'class'=>'pull-right'])!!}
                                        {{Form::hidden('_method','DELETE')}}
                                        {{Form::submit('Delete',['class'=>'btn btn-danger '])}}
                                    {!!Form::close()!!}
                                </th>
                             </tr>
                         @endforeach
                     </table>
                     @else
                     <p>You does not have post.</p>
                     @endif
                </div>
                
            </div>
            
        </div>
    </div>
</div>


@endsection
