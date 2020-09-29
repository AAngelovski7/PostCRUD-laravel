@if (count($errors)>0)
    {{-- $errors is like an object i zato e ->all()  --}}
    @foreach ($errors->all() as $error)
        <div class="allert alert-danger">
            {{$error}}
        </div>
    @endforeach
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif