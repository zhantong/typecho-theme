var current_page = 0;
function load_more_list(){
    //alert($("#load_more_button").offset().top+$("#load_more_button").height()+" "+$(window).height());
    if(current_page===0){
        $('<button id="load-more" class="btn btn-primary btn-block">加载更多</button>').insertAfter('#main');
    }
    current_page ++;
    $.ajax({
        type:'get',
        url:$('#logo').attr('href') + "page/" + current_page+"/",
        data:{'load_type':'ajax'},
        success:function(msg){
            $('#main').append($(msg).filter('.articles').html());
            if($(msg).filter('#content-title').length){
                //console.log($(msg).filter('#content-title').text());
                document.title = $(msg).filter('#content-title').text();
                window.history.pushState({"pageTitle":document.title},"", $('#logo').attr('href'));
            }
            $('#load-more').removeAttr('disabled').html('加载更多');
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
    $(window).scroll(function() {
        //console.log($("#load-more").offset().top+$("#load-more").height()-$(window).height()-$(window).scrollTop());
        if($("#load-more").offset().top+$("#load-more").height()-$(window).height()-$(window).scrollTop()<3){
            load_more_list();
        }
    });
}
$(document).ready(function() {
    $(document).on('click','.post-url,#prev-next-posts li a',function(){
        load_page($(this).attr('href'),'post');
        return false;
    });
    $(document).on('click','#toc-bar .category a,#main .category a,#main .tag a',function(){
        load_page($(this).attr('href'),'tag');
        return false;
    });
    $('#sidebar .page-url').click(function(){
        //console.log($(this).attr('href'));
        load_page($(this).attr('href'),'page');
        return false;
    });
    $(document).on('click','.main-page',function(){
        process_post_list();
        return false;
    });
    $(document).on('click','#load-more',function(){
        $(this).attr('disabled','disabled').html('加载中...');
        load_more_list();
    });
    if(!$.trim($('#main').html())){
        $('#mian-page-url').click();
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
    $('#search button').click(function(){
        keywords=$('#search input').val();
        the_url=$('#logo').attr('href') + "search/" + keywords+"/";
        load_page(the_url,'tag');
    });
    $(document).on('hidden.bs.collapse','.collapse',function(){
        $(this).siblings('.panel-heading').find(".collapse-toggle-icon").removeClass('glyphicon-resize-small').addClass('glyphicon-resize-full');
    });
    $(document).on('shown.bs.collapse','.collapse',function(){
        $(this).siblings('.panel-heading').find(".collapse-toggle-icon").removeClass('glyphicon-resize-full').addClass('glyphicon-resize-small');
    });
});
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
    //console.log(msg);
    if(type=='post'){
        $('#show-in-post').show();
        $('#show-not-in-post').hide();
        $('#main').html($(msg).filter('article'));
        $(msg).filter('#comments').insertAfter('#main article');
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
        $('#main').html($(msg).filter('article'));
    }
    else if(type=='tag'){
        $('#show-in-post').hide();
        $('#show-not-in-post').show();
        $('#main').html($(msg).filter('article'));
    }
    $(window).scrollTop(0);
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
            $('#mian-page-url').click();
        }
    }
};
