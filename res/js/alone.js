var current_page = 0;
function load_more_list(){
    //alert($("#load_more_button").offset().top+$("#load_more_button").height()+" "+$(window).height());
    if(current_page===0){
        $('<button id="load-more" class="btn btn-primary btn-block">加载更多</button>').insertAfter('#content');
    }
    current_page ++;
    $.ajax({
        type:'get',
        url:$('#logo').attr('href') + "page/" + current_page+"/",
        data:{'load_type':'ajax'},
        success:function(msg){
            $('#content').append($(msg).filter('.articles').html());
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
    $('#content').empty();
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
    $(document).on('click','#relatedbar .category a,#content .category a,#content .tag a',function(){
        load_page($(this).attr('href'),'tag');
        return false;
    });
    $('#navbar-content .page-url').click(function(){
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
    if(!$.trim($('#content').html())){
        $('#main-page-url').click();
    }
    $('#toc').toc({
        'container':'#content .post-content'
    });
    if($('#content .post-title').length){
        $('#show-in-post').show();
        $('#show-not-in-post').hide();
        $('#collapse-toc-page').collapse('show');
        $('#collapse-list-related-posts').collapse('show');
        $('#collapse-list-prev-next-posts').collapse('show');
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
        $(this).siblings('.panel-heading').find("i").removeClass('fa-chevron-up').addClass('fa-chevron-down');
    });
    $(document).on('shown.bs.collapse','.collapse',function(){
        $(this).siblings('.panel-heading').find("i").removeClass('fa-chevron-down').addClass('fa-chevron-up');
    });
    $(document).on('click','th',function(){
        var table = $(this).parents('table').eq(0);
        var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()));
        this.asc = !this.asc;
        if (!this.asc){rows = rows.reverse();}
        table.children('tbody').empty().html(rows).hide().fadeIn();
    });
});
function comparer(index) {
    return function(a, b) {
        var valA = getCellValue(a, index), valB = getCellValue(b, index);
        return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB);
    };
}
function getCellValue(row, index){return $(row).children('td').eq(index).text();}
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
        $('#content').html($(msg).filter('article'));
        $(msg).filter('#comments').insertAfter('#content article');
        $('#related-posts').remove();
        $('#show-in-post').append($(msg).filter('#related-posts'));
        $('#prev-next-posts').remove();
        $('#show-in-post').append($(msg).filter('#prev-next-posts'));
        $('#toc').toc({
            'container':'#content .post-content'
        });
        $('#collapse-toc-page').collapse('show');
        $('#collapse-list-related-posts').collapse('show');
        $('#collapse-list-prev-next-posts').collapse('show');
    }
    else if(type=='page'){
        $('#show-in-post').hide();
        $('#show-not-in-post').show();
        $('#content').html($(msg).filter('article'));
    }
    else if(type=='tag'){
        $('#show-in-post').hide();
        $('#show-not-in-post').show();
        $('#content').html($(msg).filter('article'));
    }
    $(window).scrollTop(0);
    $('#middle').hide().fadeIn();
}
window.onpopstate = function(event){
    if(event.state){
        if('html' in event.state){
            $('#content').html(event.state.html);
            if($('#content .post-title').length){
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
            $('#main-page-url').click();
        }
    }
};

// toc start
(function($) {
var verboseIdCache = {};
$.fn.toc = function(options) {
  var self = this;
  var opts = $.extend({}, jQuery.fn.toc.defaults, options);

  var container = $(opts.container);
  var headings = $(opts.selectors, container);
  var headingOffsets = [];
  var activeClassName = opts.activeClass;

  var scrollTo = function(e, callback) {
    if (opts.smoothScrolling && typeof opts.smoothScrolling === 'function') {
      e.preventDefault();
      var elScrollTo = $(e.target).attr('href');

      opts.smoothScrolling(elScrollTo, opts, callback);
    }
    $('li', self).removeClass(activeClassName);
    $(e.target).parent().addClass(activeClassName);
  };

  //highlight on scroll
  var timeout;
  var highlightOnScroll = function(e) {
    if (timeout) {
      clearTimeout(timeout);
    }
    timeout = setTimeout(function() {
      var top = $(window).scrollTop(),
        highlighted, closest = Number.MAX_VALUE, index = 0;

      for (var i = 0, c = headingOffsets.length; i < c; i++) {
        var currentClosest = Math.abs(headingOffsets[i] - top);
        if (currentClosest < closest) {
          index = i;
          closest = currentClosest;
        }
      }

      $('li', self).removeClass(activeClassName);
      highlighted = $('li:eq('+ index +')', self).addClass(activeClassName);
      opts.onHighlight(highlighted);
    }, 50);
  };
  if (opts.highlightOnScroll) {
    $(window).bind('scroll', highlightOnScroll);
    highlightOnScroll();
  }

  return this.each(function() {
    //build TOC
    var el = $(this);
    var ul = $(opts.listType);

    headings.each(function(i, heading) {
      var $h = $(heading);
      headingOffsets.push($h.offset().top - opts.highlightOffset);

      var anchorName = opts.anchorName(i, heading, opts.prefix);

      //add anchor
      if(heading.id !== anchorName) {
        var anchor = $('<span/>').attr('id', anchorName).insertBefore($h);
      }

      //build TOC item
      var a = $('<a/>')
        .text(opts.headerText(i, heading, $h))
        .attr('href', '#' + anchorName)
        .bind('click', function(e) {
          $(window).unbind('scroll', highlightOnScroll);
          scrollTo(e, function() {
            $(window).bind('scroll', highlightOnScroll);
          });
          el.trigger('selected', $(this).attr('href'));
        });

      var li = $('<li/>')
        .addClass(opts.itemClass(i, heading, $h, opts.prefix))
        .append(a);

      ul.append(li);
    });
    el.html(ul);
  });
};


jQuery.fn.toc.defaults = {
  container: 'body',
  listType: '<ul/>',
  selectors: 'h1,h2,h3',
  smoothScrolling: function(target, options, callback) {
      $(document.body).animate({scrollTop:$(target).offset().top}, 300 );
      /*
    $(target).smoothScroller({
      offset: options.scrollToOffset
    }).on('smoothScrollerComplete', function() {
      callback();
    });
    */
  },
  scrollToOffset: 0,
  prefix: 'toc',
  activeClass: 'toc-active',
  onHighlight: function() {},
  highlightOnScroll: true,
  highlightOffset: 100,
  anchorName: function(i, heading, prefix) {
    if(heading.id.length) {
      return heading.id;
    }
    //console.log(i+"\t"+heading+"\t"+prefix);
    return prefix+'-'+i;
    var candidateId = $(heading).text().replace(/[^a-z0-9]/ig, ' ').replace(/\s+/g, '-').toLowerCase();
    if (verboseIdCache[candidateId]) {
      var j = 2;

      while(verboseIdCache[candidateId + j]) {
        j++;
      }
      candidateId = candidateId + '-' + j;

    }
    verboseIdCache[candidateId] = true;

    return prefix + '-' + candidateId;
  },
  headerText: function(i, heading, $heading) {
    return $heading.data('toc-title') || $heading.text();
  },
  itemClass: function(i, heading, $heading, prefix) {
    return prefix + '-' + $heading[0].tagName.toLowerCase();
  }

};

})(jQuery);
// toc end
