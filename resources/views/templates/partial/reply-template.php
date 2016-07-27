<!--template for reply-->
<template id="reply-template">
    <div class="media">
        <a class="pull-left" href="/profile/{{username}}/">
            <img class="media-object" alt="{{username}}" src="https://gravatar.com/avatar/{{user.email}}?d=mm&s=30">
        </a>
        <div class="media-body">
            <h5 class="media-heading"><a href=/profile/{{user.username}}>{{user.lastname}} {{user.firstname}}</a></h5>
            <p class="reply-body">{{body}}</p>
            <ul class="list-inline">
                <li class="ago"></li>
                <li><a class="like" data-id="{{sid}}" href="">Like</a></li>
                <li class="like-count">0 likes</li>
            </ul>
        </div>
    </div>
</template>