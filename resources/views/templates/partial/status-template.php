<!--template for status-->
<template id="status-template">
    <div class="media status-block">
        <a class="pull-left" href="/profile/{{username}}/">
            <img class="media-object" alt="{{username}}" src="https://gravatar.com/avatar/{{user.email}}?d=mm&s=50">
        </a>
        <div class="media-body">
            <h4 class="media-heading"><a href="/profile/{{username}}/">{{user.lastname}} {{user.firstname}}</a></h4>
            <p>{{body}}</p>
            <ul class="list-inline">
                <li class="ago"></li>
                <li><a class="like" data-id="{{sid}}" href="">Like</a></li>
                <li class="like-count">0 likes</li>
            </ul>
            <form role="form" action="" method="post" class="appended-section">
                <div class="form-group">
                    <input placeholder="Reply to this status..." type="text" data-id="{{sid}}" name="reply-{{sid}}" class="form-control txt_reply">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
            </form>
            <div class="reply-section">

            </div>
        </div>
    </div>
</template>