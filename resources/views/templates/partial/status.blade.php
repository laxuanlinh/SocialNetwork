<div class="media status-block">
    <a class="pull-left" href="{{route('profile', ['username'=>$status->user->username])}}">
        <img class="media-object" alt="{{$status->user->getFirstNameOrUsername()}}" src="{{$status->user->getAvatarUrl()}}">
    </a>
    <div class="media-body">
        <h4 class="media-heading"><a href="{{route('profile', ['username'=>$status->user->username])}}">{{$status->user->getNameOrUsername()}}</a></h4>
        <p>{{$status->body}}</p>
        <ul class="list-inline">
            <li>{{$status->created_at->diffForHumans()}}</li>

            @if(!Auth::user()->hasLikedStatus($status))
                <li><a class="like" data-id="{{$status->sid}}" href="">Like</a></li>
            @else
                <li><a class="dislike" data-id="{{$status->sid}}" href="">Dislike</a></li>
            @endif

            <li class="like-count">{{$status->likes->count()}} likes</li>
        </ul>
        <form role="form" action="" method="post">
            @if($errors->has("reply-{$status->sid}"))
                <div class="form-group has-error">
                    @else
                        <div class="form-group">
                            @endif
                            {{--<textarea wrap="hard" data-id="{{$status->sid}}" name="reply-{{$status->sid}}" class="form-control txt_reply" rows="1" placeholder="Reply to this status"></textarea>--}}
                            <input placeholder="Reply to this status..." type="text" data-id="{{$status->sid}}" name="reply-{{$status->sid}}" class="form-control txt_reply">
                            @if($errors->has("reply-{$status->sid}"))
                                <span class="help-block">{{ $errors->first("reply-{$status->sid}") }}</span>
                            @endif
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
        <div class="reply-section">
            @foreach($status->replies as $reply)
                <div class="media">
                    <a class="pull-left" href="{{route('profile', ['username'=>$reply->user->username])}}">
                        <img class="media-object" alt="{{$reply->user->getFirstNameOrUsername()}}" src="{{$reply->user->getSmallAvatarUrl()}}">
                    </a>
                    <div class="media-body">
                        <h5 class="media-heading"><a href="{{route('profile', ['username'=>$reply->user->username])}}">{{$reply->user->getNameOrUsername()}}</a></h5>
                        <p>{{$reply->body}}</p>
                        <ul class="list-inline">
                            <li>{{$reply->created_at->diffForHumans()}}</li>
                            @if(!Auth::user()->hasLikedStatus($reply))
                                <li><a class="like" data-id="{{$reply->sid}}" href="">Like</a></li>
                            @else
                                <li><a class="dislike" data-id="{{$reply->sid}}" href="">Dislike</a></li>
                            @endif
                            <li class="like-count">{{$reply->likes->count()}} likes</li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>