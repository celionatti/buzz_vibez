$(document).ready(function () {

    convertTime = (time) => {
        return new Date(time).toLocaleDateString('en-us', {
            year: "numeric",
            month: "short",
            day: "numeric"
        })
    }

    load_comment();
    // Load Comment.
    function load_comment() { 
        var slug = $(".slug").val();

        $.ajax({
          type: "POST",
          url: "/blog/loadComment/" + slug,
            data: {
              'comment_load_data':true
          },
            success: function (response) {
                $(".comment-container").html("");
                $.each(response, function (key, value) {  
                    $(".comment-container").
                        append('<div class="reply_box border p-2 mb-2">\
                            <h6 class="border-bottom d-inline">'+ value['username'] +' <span class="float-end"><i class="bi bi-clock"></i> '+ convertTime(value['created_at']) +'</span></h6>\
                            <p class="params">'+ value['message'] +'</p>\
                            <button value="'+ value['id'] +'" class="btn btn-sm btn-warning reply_btn">Reply</button>\
                            <button value="'+ value['id'] +'" class="btn btn-sm btn-danger view_reply_btn">View Replies</button>\
                            <div class="mx-5 reply_section"></div>\
                        </div>\
                    ');
                });
          },
        });
    }
    
    // Add Reply Input.
    $(document).on('click', '.reply_btn', function () {
        var thisClicked = $(this);
        var comment_id = thisClicked;

        $('.reply_section').html('');
        thisClicked.closest('.reply_box').find('.reply_section').
            html('<input type="text" class="reply_msg form-control my-2" placeholder="Reply">\
                <div class="text-end">\
                <button class="btn btn-sm btn-primary reply_add_btn">Reply</button>\
                <button class="btn btn-sm btn-danger reply_cancel_btn">Cancel</button>\
                </div>');
    });

    // Cancel Reply Btn.
    $(document).on("click", ".reply_cancel_btn", function () {
        $(".reply_section").html("");
    });

    // Add Reply comment.
    $(document).on('click', '.reply_add_btn', function (e) {
        e.preventDefault();

        var thisClicked = $(this);
        var comment_id = thisClicked.closest('.reply_box').find('.reply_btn').val();
        var reply = thisClicked.closest('.reply_box').find('.reply_msg').val();

        data = {
            'comment_id': comment_id,
            'reply_msg': reply,
            'add_reply': true
        };
        $.ajax({
            type: "POST",
            url: "/blog/addReplyComment",
            data: data,
            success: function (response) {
                alert(response);
                $(".reply_section").html("");
            }
        });
    });

    // View All Replies.
    $(document).on('click', '.view_reply_btn', function (e) {
        e.preventDefault();

        var thisClicked = $(this);
        var comment_id = thisClicked.val();

        $.ajax({
            type: "POST",
            url: "/blog/viewCommentReplies",
            data: {
                'comment_id': comment_id,
                'view_comment_data': true
            },
            success: function (response) {
                $(".reply_section").html("");

                $.each(response, function (key, value) { 
                   thisClicked.closest(".reply_box").find(".reply_section").append(
                  '<div class="sub_reply_box border-bottom p-2 mb-2">\
                    <input type="hidden" class="get_username" value="'+ value['username'] +'"/>\
                    <h6 class="border-bottom d-inline">'+ value['username'] +' <span class="float-end"><i class="bi bi-clock"></i> '+ convertTime(value['created_at']) +'</span></h6>\
                    <p class="params">'+ value['reply_msg'] +'</p>\
                    <button value="'+ value['comment_id'] +'" class="btn btn-sm btn-warning sub_reply_btn">Reply</button>\
                    <div class="ml-4 sub_reply_section"></div>\
                    </div>\
                    ');  
                });
            }
        });
    });

    // Sub Reply Add.
    $(document).on("click", ".sub_reply_btn", function (e) {
        e.preventDefault();

        var thisClicked = $(this);
        var comment_id = thisClicked.val();

        var username = thisClicked.closest('.sub_reply_box').find('.get_username').val();

        $('.sub_reply_section').html("");

        thisClicked.closest('.sub_reply_box').find('.sub_reply_section').
            append('<div class="my-2">\
                <input type="text" value="#'+ username +': " class="sub_reply_msg form-control" placeholder="Your Reply..." />\
                </div>\
                <div class="text-end">\
                    <button class="btn btn-sm btn-primary sub_reply_add_btn">Reply</button>\
                    <button class="btn btn-sm btn-danger sub_reply_cancel_btn">Cancel</button>\
                </div >\
            ');
    });

    //Cancel Sub Reply Input.
    $(document).on("click", ".sub_reply_cancel_btn", function (e) {
        e.preventDefault();

        $(".sub_reply_section").html("");
    });


    //Add Sub Reply Comment.
    $(document).on("click", ".sub_reply_add_btn", function (e) {
      e.preventDefault();

        var thisClicked = $(this);
        var comment_id = thisClicked.closest('.sub_reply_box').find('.sub_reply_btn').val();
        var reply = thisClicked.closest('.sub_reply_box').find('.sub_reply_msg').val();

        var data = {
            'comment_id': comment_id,
            'reply_msg': reply,
            'add_sub_replies': true
        };

        $.ajax({
            type: "POST",
            url: "/blog/addSubReplies",
            data: data,
            success: function (response) {
                $('.reply_section').html("");
                alert(response);
            }
        });
    });

    
    // Add Comment.
    $(".add_comment_btn").click(function (e) {
        e.preventDefault();

        var msg = $('.comment_textbox').val();
        var slug = $('.slug').val();

        if ($.trim(msg).length == 0) {
            error_msg = "Please type Comment";
            $('#error_status').text(error_msg);
        } else {
            error_msg = "";
            $("#error_status").text(error_msg);
        }

        if (error_msg != '') {
            return false;
        } else {
            var data = {
                'msg': msg,
                'slug': slug,
                'add_comment': true
            };

            $.ajax({
                type: "POST",
                url: "/blog/comment",
                data: data,
                success: function (response) {
                    alert(response);
                    $(".comment_textbox").val("");
                }
            });
        }
    });
    // End.
});
