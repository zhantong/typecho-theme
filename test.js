var current_page = 0;
function load_more_list(){
    //alert($("#load_more_button").offset().top+$("#load_more_button").height()+" "+$(window).height());
    if(current_page===0){
        $('#m-nav').append('<div id="load-more" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 90%">加载中...</div>');
    }
    current_page ++;
    $.ajax({
        type:'get',
        url:$('#logo').attr('href') + "page/" + current_page+"/",
        data:{'load_type':'ajax'},
        success:function(msg){
            $('#main').append(msg);
        }
    });
}
$(document).ready(function() {
    $('#body').offset({'top':$('#header').height()});
    $('#navigation').offset({'top':$('#header').height()});
    //load_more_list();
    $(document).on('click','.post-url',function(){
        load_page($(this).attr('href'));
        return false;
    });
    $(document).on('click','#more-post',function(){
        current_page = 0;
        $('#load-more').remove();
        $('#main').empty();
        load_more_list();
        load_more_list();
        $(window).scroll(function() {
            //console.log($("#load-more").offset().top+$("#load-more").height()-$(window).height()-$(window).scrollTop());
            if($("#load-more").offset().top+$("#load-more").height()-$(window).height()-$(window).scrollTop()<3){
                load_more_list();
            }
        });
        //window.history.pushState({"pageTitle":document.title},"", $('#logo').attr('href'));
        return false;
    });
    $('#sidebar .page').click(function(){
        //console.log($(this).attr('href'));
        load_page($(this).attr('href'));
        return false;
    });
    if($('#main').is(':empty')){
        $('#more-post').click();
    }
    $('#toc').toc({
        'container':'#main .post-content'
    });
});

$('#sidebar').affix({
      offset: {
        top: 200
      }
});
/*
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
*/
function clean_up(){
    if($('#load-more').length){
        $(window).unbind('scroll');
        $('#load-more').remove();
        window.history.pushState({"pageTitle":document.title},"", document.url);
    }
}
function load_page(the_url){
    $.ajax({
        beforeSend:function(){
            clean_up();
        },
        type:'get',
        url:the_url,
        data:{'load_type':'ajax'},
        success:function(msg){
            //console.log(msg);
            //console.log($(msg).filter('#content-title').text());
            $('#main').html(msg);
            document.title = $(msg).filter('#content-title').text();
            window.history.pushState({"html":msg,"pageTitle":document.title},"", the_url);
            $('#toc').toc({
                'container':'#main .post-content'
            });
        }
    });
}
window.onpopstate = function(event){
    if(event.state){
        if('html' in event.state){
            $('#main').html(event.state.html);
        }
        else{
            $('#more-post').click();
        }
        document.title = event.state.pageTitle;
    }
};
