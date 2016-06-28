@extends('templates.default')
@section('content')
    <div class="row">
        <div class="col-lg-5">
            @include('templates.partial.userblock')
            <div class="col-lg-12">
                @if(!$statuses->count())
                    <p>Nothing to see here</p>
                @else
                    @foreach($statuses as $status)
                        @include('templates.partial.status')
                    @endforeach
                    {!! $statuses->render() !!}
                @endif
            </div>
        </div>
        <div class="col-lg-4 col-lg-offset-3">
            @if(Auth::user()->hasFriendRequestPending($user))
                <p>Waiting for {{$user->getNameOrUsername()}} to accept your friend request</p>
            @elseif(Auth::user()->hasFriendRequestReceived($user))
                <a href="{{ route('acceptfriend', ['username'=>$user->username]) }}" class="btn btn-primary">Accept friend request</a>
            @elseif(Auth::user()->isFriendWith($user))
                <p>You and {{$user->getNameOrUsername()}} are friends</p>
                <form action="{{route('deletefriend', ['user'=>$user->username])}}" method="post">
                    <input type="submit" class="btn-primary" value="Delete friend">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                </form>
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