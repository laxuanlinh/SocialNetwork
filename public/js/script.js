$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    jQuery("time.timeago").timeago();

    //this one is for comment
    $('body').on('keypress', '.txt_reply', function(e){
        if (e.which==13){
            e.preventDefault();
            var $parent=$(this).closest('.media-body').find('.reply-section');
            console.log($parent);
            var template=$('#reply-template').html();
            var $sid=$(this).data('id');
            var $datastring='sid='+$sid+'&body='+$(this).val();
            if($(this).val().length!=0){
                $.ajax({
                    type : 'POST',
                    url : '/status/reply',
                    data : $datastring,
                    success : function(data){
                        $parent.prepend(Mustache.render(template, data));
                        $parent.find('.ago').first().text(jQuery.timeago(data.created_at));
                    },
                    error : function(data){
                        console.log(data.msg);
                    }
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
    $('body').on('click', '.like', function(e){
        e.preventDefault();
        var $sid=$(this).data('id');
        var $datastring='sid='+$sid;
        var $like=$(this);
        $.ajax({
            type : 'POST',
            url : '/status/like',
            data : $datastring,
            success : function(data){
                $like.text('Dislike');
                $like.attr('class', 'dislike');
                getLikeCount(data.sid, function (output) {
                    $like.closest('.media-body').find('.like-count').text(output+" likes");
                })
            },
            error : function(){
                console.log('undone');
            }
        });
    })

    //dislike
    $('body').on('click', '.dislike', function(e){
        console.log('dislike');
        e.preventDefault();
        console.log($(this).data('id'));
        var $sid=$(this).data('id');
        var $datastring='sid='+$sid;
        var $like=$(this);
        console.log($like);
        $.ajax({
            type : 'POST',
            url : '/status/dislike',
            data : $datastring,
            success : function(){
                $like.text('Like');
                $like.attr('class', 'like');
                console.log('done');
            },
            error : function(){
                console.log('undone');
            }
        });
    });

    //like count
    function getLikeCount($sid, changeLikeCount)
    {
        var $datastring='sid='+$sid;
        $.ajax({
            type : 'GET',
            url : 'status/like/count',
            data : $datastring,
            success : function(data){
                changeLikeCount(data);

            },
            error : function(){
                console.log('undone');
            }
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
            $.ajax({
                type : 'POST',
                url : '/status',
                data : $datastring,
                success : function(data){
                    $('#status-section').prepend(Mustache.render(template, data));
                    $('#status-section').find('.ago').first().text(jQuery.timeago(data.created_at));
                    console.log(data);
                    $('#status').val('');
                },
                error :  function(){
                    console.log('failed');
                }
            });
        }
    })
});



















