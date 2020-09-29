
@extends('layouts.app')


@section('content')
{{-- print title element from data array and then loop throug services elements and print their elements --}}
    <h1>{{$title}}</h1>
    @if(count($services) >0)
        <ul class="list-group">
            @foreach ($services as $service)
                <li class="list-group-item">{{$service}}</li>
            @endforeach
        </ul>
    @endif
<p>This is service page</p>
@endsection


      

   