var current_page = 0;
function load_more_list(){
    //alert($("#load_more_button").offset().top+$("#load_more_button").height()+" "+$(window).height());
    current_page ++;
    $.ajax({
        type:'get',
        url:$('#logo').attr('href') + "page/" + current_page+"/?load_type=ajax",
        success:function(msg){
            $('#main').append(msg);
        }
    });
}
$(document).ready(function() {
    $('.box').offset({'top':$('#header').height()});
    load_more_list();
    $(document).on('click','.post-url',function(){
        load_post($(this).attr('href'));
        return false;
    });
    $('#m-nav').scroll(function() {
        if($("#load-more").offset().top+$("#load-more").height()-$(window).height()<3){
            load_more_list();
        }
    });
    $('#m-nav').scroll();
});


function load_post(post_url){
    $.ajax({
        beforeSend:function(){
            $('#post').empty();
        },
        type:'get',
        url:post_url,
        data:{'type':'ajax'},
        success:function(msg){
            $('#post').html(msg);
            document.title = $(msg).find('.post-title').text();
            window.history.pushState({"html":msg,"pageTitle":document.title},"", post_url);
        }
    });
}
window.onpopstate = function(event){
    if(event.state){
        $('#post').html(event.state.html);
        document.title = event.state.pageTitle;
    }
};
