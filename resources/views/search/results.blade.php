@extends('templates.default')
@section('content')
    <h3>Your search for "{{ Request::input('query') }}"</h3>
    @if(!$users->count())
        <p>No result</p>
    @else
        <div class="row">
            <div class="col-lg-12">
                @foreach($users as $user)
                    @include('templates.partial.userblock')
                @endforeach
            </div>
        </div>
        
    @endif
@stop