$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    jQuery("time.timeago").timeago();

    //this one is for comment
    $('body').on('keypress', '.txt_reply', function (e) {

        if (e.which == 13) {
            e.preventDefault();
            var $parent = $(this).closest('.media-body').find('.reply-section');
            var template = $('#reply-template').html();
            var $sid = $(this).data('id');
            var $datastring = 'sid=' + $sid + '&body=' + $(this).val();
            console.log($datastring);
            if ($(this).val().length != 0) {
                $.post('/status/reply',
                    {
                        sid: $sid,
                        body: $(this).val(),
                        '_token': $('meta[name=csrf-token]').attr('content')

                    }, function (data) {
                        $parent.prepend(Mustache.render(template, data));
                        $parent.find('.ago').first().text(jQuery.timeago(data.created_at));
                        textToEmo($parent.find('.reply-body').first());
                    });
                $(this).val('');
                //$(this).blur();
            } else {
                return;
            }
        } else {
            return;
        }
    });


    //like
    $('body').on('click', '.like', function (e) {
        e.preventDefault();
        var $sid = $(this).data('id');
        var $datastring = 'sid=' + $sid;
        var $like = $(this);
        $.post('/status/like',
            {
                sid: $sid
            },function (data) {
                $like.text('Dislike');
                $like.attr('class', 'dislike');
                getLikeCount(data.sid, function (output) {
                    $like.closest('.media-body').find('.like-count').text(output + " likes");
                })
            }
        );
    })

    //dislike
    $('body').on('click', '.dislike', function (e) {
        console.log('dislike');
        e.preventDefault();
        console.log($(this).data('id'));
        var $sid = $(this).data('id');
        var $datastring = 'sid=' + $sid;
        var $like = $(this);
        console.log($like);
        $.post('/status/dislike',
            {
                sid: $sid
            }, function (data) {
                $like.text('Like');
                $like.attr('class', 'like');
                console.log('done');
                getLikeCount(data.sid, function (output) {
                    console.log(output);
                    $like.closest('.media-body').find('.like-count').text(output + " likes");
                })
            });
    });

    //like count
    function getLikeCount($sid, changeLikeCount) {
        $.get('status/like/count',
            {
                sid: $sid
            }, function (data) {
                changeLikeCount(data);
            });
    }

    //post status
    $('#postBtn').click( function (e) {
        e.preventDefault();
        var $body=$(this).closest('form').find('textarea').val();
        var template=$('#status-template').html();
        if ($body!=='')
        {
            var $datastring='body='+$body;
            $.post('/status',
                {
                    body: $body
                }, function(data){
                    $('#status-section').prepend(Mustache.render(template, data));
                    $('#status-section').find('.ago').first().text(jQuery.timeago(data.created_at));
                    console.log(data);
                    $('#status').val('');
                }
            );
        }
    });

    //convert text to emoticons

    $('.reply-body').each(function (i, obj) {
        textToEmo($(this));
    });

    $('.status-body').each(function (i, obj) {
        textToEmo($(this));
    });

    function textToEmo(e) {
        var res = e.emoticons();
        e.html(res);
    }


});



















