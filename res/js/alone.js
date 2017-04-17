var current_page;
function load_more_list(){
    //alert($("#load_more_button").offset().top+$("#load_more_button").height()+" "+$(window).height());
    if(current_page===0){
        $('<button id="load-more" class="btn btn-primary btn-block">加载更多</button>').insertAfter('#content');
    }
    current_page ++;
    $.ajax({
        type:'get',
        url:$('#logo').attr('href') + "page/" + current_page+"/",
        success:function(msg){
            $('#content').append($(msg).filter('.articles').html());
            $('#load-more').removeAttr('disabled').html('加载更多');
        }
    });
}
function process_post_list(){
    current_page = 0;
    load_more_list();
    $(window).scroll(function() {
        //console.log($("#load-more").offset().top+$("#load-more").height()-$(window).height()-$(window).scrollTop());
        if($("#load-more").offset().top+$("#load-more").height()-$(window).height()-$(window).scrollTop()<3){
            load_more_list();
        }
    });
}
$(document).ready(function() {
    $(document).on('click','#load-more',function(){
        $(this).attr('disabled','disabled').html('加载中...');
        load_more_list();
    });
    if(!$.trim($('#content').html())){
        process_post_list();
    }
    $('#toc').toc({
        'container':'#content .post-content'
    });
    $('#search button').click(function(){
        keywords=$('#search input').val();
        the_url=$('#logo').attr('href') + "search/" + keywords+"/";
        window.open(the_url,'_blank');
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

    $('#collapse-toc-page').collapse('show');
    $('#collapse-list-related-posts').collapse('show');
    $('#collapse-list-prev-next-posts').collapse('show');
    $('#collapse-list-category').collapse('show');
});
function comparer(index) {
    return function(a, b) {
        var valA = getCellValue(a, index), valB = getCellValue(b, index);
        return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB);
    };
}
function getCellValue(row, index){return $(row).children('td').eq(index).text();}

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
