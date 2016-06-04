@extends('templates.default')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h3>Your friends</h3>
            @if(!$friends->count())
                <p>Suck it, no one wants to be your friend</p>
            @else
                @foreach($friends as $user)
                    @include('templates.partial.userblock')
                @endforeach
            @endif
        </div>
        <div class="col-lg-6">
            <h4>Friend requests</h4>
            @if(!$friends->count())
                <p>No friend request</p>
            @else
                @foreach($friendRequests as $user)
                    @include('templates.partial.userblock')
                @endforeach
            @endif
        </div>
    </div>
@stop