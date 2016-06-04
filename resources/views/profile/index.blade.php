@extends('templates.default')
@section('content')
    <div class="row">
        @include('templates.partial.alert')
        <div class="col-lg-5">
            @include('templates.partial.userblock')
        </div>
        <div class="col-lg-4 col-lg-offset-3">
            @if(Auth::user()->hasFriendRequestPending($user))
                <p>Waiting for {{$user->getNameOrUsername()}} to accept your friend request</p>
            @elseif(Auth::user()->hasFriendRequestReceived($user))
                <a href="#" class="btn btn-primary">Accept friend request</a>
            @elseif(Auth::user()->isFriendWith($user))
                <p>You and {{$user->getNameOrUsername()}} are friends</p>
            @elseif($user!=Auth::user())
                <a href="{{route('addfriend', ['username'=>$user->username])}}" class="btn btn-primary">Add as friend</a>
            @endif
            @if(!$user->friends()->count())
                <p>{{$user->getNameOrUsername()}} has no friend</p>
            @else
                <p>{{$user->getNameOrUsername()}}'s friends</p>
                @foreach($user->friends() as $user)
                    @include('templates.partial.userblock')
                @endforeach
            @endif
        </div>
    </div>
@stop