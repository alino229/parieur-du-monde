
$(function(){
    var b=location.protocol+"//"+location.hostname;
    $('a[href^="http://"], a[href^="https://"]').not('[href^="'+b+'"]').attr("target","_blank");
    $(".home__article--text ol ").addClass("publish_list");
    $(".home__article--text ul ").addClass("publish_list");
    $(".home__article--text blockquote ").addClass("publish_blockquote");
    $(".reponse-text blockquote").addClass("publish_blockquote");
    $(".home__article--text a").not(".btn_text ").addClass("publish_link").hover().css("text-decoration","underline");
    $(".home__article--text table ").addClass("publish_table");


})(jQuery);