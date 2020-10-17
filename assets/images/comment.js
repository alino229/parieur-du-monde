jQuery(document).ready(function(){
    var a=$(".replay");
    var b=$(".comment-container");
    var g=$(".cancel-comment-reply-link");
    var h=$('.article-commentaire');

    $(".cancel-comment-reply-link").click(function(){
        alert("hello");
    });
    a.click(function(){
        var e=$(this);
        var c=e.data("id");
        var d=$("#comment-"+c);
        var f=$(".replay .comment_replay-link");

        b.find("h3").text("répondre à ce commentaire");
              $("#id_parent").val(c);
              d.after(b);

        // f.addClass('cancel-comment-reply-link');
        //       $(this).removeClass('replay');
    });
    $(".cancel-comment-reply-link").click(function () {
        alert('hello');

    });

    });