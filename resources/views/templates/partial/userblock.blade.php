<div class="media">
    <a class="pull-left" href="#">
        <img class="media-object" alt="" src="{{ $user->getAvatarUrl() }}">
    </a>
    <div class="media-body">
        <h4 class="media-heading">
            <a href="/profile/{{$user->username}}">
                {{ $user->getNameOrUsername() }}
            </a>
        </h4>
        @if($user->location)
            <p>{{ $user->location }}</p>
        @endif
    </div>
</div>