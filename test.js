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
            if($(msg).filter('#content-title').length){
                //console.log($(msg).filter('#content-title').text());
                document.title = $(msg).filter('#content-title').text();
                window.history.pushState({"pageTitle":document.title},"", $('#logo').attr('href'));
            }
        }
    });
}
function process_post_list(){
    current_page = 0;
    $('#load-more').remove();
    $('#main').empty();
    $('#show-in-post').hide();
    $('#show-not-in-post').show();
    load_more_list();
    load_more_list();
    $(window).scroll(function() {
        //console.log($("#load-more").offset().top+$("#load-more").height()-$(window).height()-$(window).scrollTop());
        if($("#load-more").offset().top+$("#load-more").height()-$(window).height()-$(window).scrollTop()<3){
            load_more_list();
        }
    });
}
$(document).ready(function() {
    $('#body').offset({'top':$('#header').height()});
    $('#navigation').offset({'top':$('#header').height()});
    //load_more_list();
    $(document).on('click','.post-url',function(){
        load_page($(this).attr('href'),'post');
        return false;
    });
    $(document).on('click','#toc-bar .category a',function(){
        load_page($(this).attr('href'),'tag');
        return false;
    });
    $(document).on('click','#main .category a',function(){
        load_page($(this).attr('href'),'tag');
        return false;
    });
    $(document).on('click','#main .tag a',function(){
        load_page($(this).attr('href'),'tag');
        return false;
    });
    $(document).on('click','#more-post',function(){
        process_post_list()
        return false;
    });
    $('#sidebar .page-url').click(function(){
        //console.log($(this).attr('href'));
        load_page($(this).attr('href'),'page');
        return false;
    });
    if($('#main').is(':empty')){
        $('#more-post').click();
    }
    $('#toc').toc({
        'container':'#main .post-content'
    });
    if($('#main .post-title').length){
        $('#show-in-post').show();
        $('#show-not-in-post').hide();
    }
    else{
        $('#show-in-post').hide();
        $('#show-not-in-post').show();
    }
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
    }
}
function load_page(the_url,type){
    $.ajax({
        beforeSend:function(){
            //console.log('load_page');
            clean_up();
        },
        type:'get',
        url:the_url,
        data:{'load_type':'ajax'},
        success:function(msg){
            //console.log(msg);
            //console.log($(msg).filter('#content-title').text());
            process_content(msg,type);
            document.title = $(msg).filter('#content-title').text();
            window.history.pushState({"html":msg,"pageTitle":document.title},"", the_url);
        }
    });
}
function process_content(msg,type){
    if(type=='post'){
        $('#show-in-post').show();
        $('#show-not-in-post').hide();
        $('#main').html($(msg).filter('article').html());
        $('#related-posts').remove();
        $('#show-in-post').append($(msg).filter('#related-posts'));
        $('#prev-next-posts').remove();
        $('#show-in-post').append($(msg).filter('#prev-next-posts'));
        $('#toc').toc({
            'container':'#main .post-content'
        });
    }
    else if(type=='page'){
        $('#show-in-post').hide();
        $('#show-not-in-post').show();
        $('#main').html($(msg).filter('article').html());
    }
    else if(type=='tag'){
        $('#show-in-post').hide();
        $('#show-not-in-post').show();
        $('#main').html(msg);
    }
}
window.onpopstate = function(event){
    if(event.state){
        if('html' in event.state){
            $('#main').html(event.state.html);
            if($('#main .post-title').length){
                $('#show-in-post').show();
                $('#show-not-in-post').hide();
            }
            else{
                $('#show-in-post').hide();
                $('#show-not-in-post').show();
            }
            document.title = event.state.pageTitle;
        }
        else{
            $('#more-post').click();
        }
    }
};
