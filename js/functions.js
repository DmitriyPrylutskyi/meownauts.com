$('document').ready(function(){
    
    $('#modal').modal({
    	show: false,
    	backdrop: 'static'
    })

    $('#modal').on('shown.bs.modal', function () {
      //#myInput - id элемента, которому необходимо установить фокус
      $('.search-input').focus();
    })

    $('.navbar-nav').mouseover(function(){
      var win_width = window.innerWidth;

      if (win_width >1200) {
        if ($('.menu-main-full').css('position') == "static") {
          $('div.head-logo').removeClass('head-logo').addClass('head-logo-fixed');
          document.getElementsByClassName('menu-main-full')[0].style.backgroundColor = '#efbd2d';
        }
      };
    });

    $('.navbar-nav').mouseout(function(){
      var win_width = window.innerWidth;

      if (win_width >1200) {
        if ($('.menu-main-full').css('position') == "static") {
          $('div.head-logo-fixed').removeClass('head-logo-fixed').addClass('head-logo');
          document.getElementsByClassName('menu-main-full')[0].style.backgroundColor = 'transparent';
        }
      }
    });

    $('.icon-menu-1').click(function(){
      if ($('#navbarCollapse').offset().left < 0) {
        $('#navbarCollapse').animate({left:25},500);
        $('.icon-menu-1').addClass('opened');
      }
        else {
          $('#navbarCollapse').animate({left:-500},500);
          $('.icon-menu-1').removeClass('opened');
        }
    });

    $('.navbar-nav li').click(function(event){
      var win_width = window.innerWidth;
      
      if (win_width <1200) {
        event = event || window.event;
        var targetli = event.currentTarget || event.srcElement;
        $(targetli).children('.item-wraper').slideToggle(500);
      }
    });

    $('.navbar-toggle').mouseover(function(){
      $('div.head-logo').removeClass('head-logo').addClass('head-logo-fixed');
      document.getElementsByClassName('menu-main-full')[0].style.backgroundColor = '#efbd2d';
    });

    $('.navbar-toggle').mouseout(function(){
      $('div.head-logo-fixed').removeClass('head-logo-fixed').addClass('head-logo');
      document.getElementsByClassName('menu-main-full')[0].style.backgroundColor = 'transparent';
    });

    $('.frame').mouseover(function(event){
        event = event || window.event;
        var targetframe = event.currentTarget || event.srcElement;
        var framewraper = $(targetframe).parent();
        $(framewraper).children('.scrollbar').css( "background-color", "#eee" );
        $(framewraper).children('.scrollbar').css( "opacity", "0.9" );
    });

    $('.frame').mouseout(function(event){
        event = event || window.event;
        var targetframe = event.currentTarget || event.srcElement;
        var framewraper = $(targetframe).parent();
        $(framewraper).children('.scrollbar').css('opacity','');
        $(framewraper).children('.scrollbar').css('background','');
    });

    adaptive ();

    var lastScrollTop = 0;
        $(window).scroll(function(){
          var win_width = window.innerWidth;
          if (win_width >1200) {
            var st = $(this).scrollTop();
            if (st < lastScrollTop) {
                $(".menu-main-full").css({position: 'fixed'});
                $('div.head-logo').removeClass('head-logo').addClass('head-logo-fixed');
                document.getElementsByClassName('menu-main-full')[0].style.backgroundColor = '#efbd2d';
            }
             else {
                $(".menu-main-full").css({position: 'static'});
                $('div.head-logo-fixed').removeClass('head-logo-fixed').addClass('head-logo');
                document.getElementsByClassName('menu-main-full')[0].style.backgroundColor = 'transparent';
            }

             if (st < 150) {
                $(".menu-main-full").css({position: 'static'});
                $('div.head-logo-fixed').removeClass('head-logo-fixed').addClass('head-logo');
                document.getElementsByClassName('menu-main-full')[0].style.backgroundColor = 'transparent';
             }
             lastScrollTop = st;
          }
        });

  var $frame = $('#lookCarousel');
  var $wraper = $frame.parent();
    $frame.sly ({
      horizontal: 1,
      itemNav: 'basic',
      smart:1,
      startAt: 0,
      mouseDragging: 1,
      touchDragging: 1,
      scrollBar: $wraper.find('.scrollbar'),
      scrollbarBy: 1,
      speed: 200,
      dragHandle: 1,
      dynamicHandle: 1,
      clickBar: 1,
      prev: $wraper.find('.prev'),
      next: $wraper.find('.next'),
    })
 
  var $frame = $('#playCarousel');
  var $wraper = $frame.parent();
    $frame.sly ({
      horizontal: 1,
      itemNav: 'centered',
      smart:1,
      startAt: 0,
      mouseDragging: 1,
      touchDragging: 1,
      scrollBar: $wraper.find('.scrollbar'),
      scrollbarBy: 1,
      speed: 200,
      dragHandle: 1,
      dynamicHandle: 1,
      clickBar: 1,
      prev: $wraper.find('.prev'),
      next: $wraper.find('.next'),
    })

  var $frame = $('#readCarousel');
  var $wraper = $frame.parent();
    $frame.sly ({
      horizontal: 1,
      itemNav: 'centered',
      smart:1,
      startAt: 0,
      mouseDragging: 1,
      touchDragging: 1,
      scrollBar: $wraper.find('.scrollbar'),
      scrollbarBy: 1,
      speed: 200,
      dragHandle: 1,
      dynamicHandle: 1,
      clickBar: 1,
      prev: $wraper.find('.prev'),
      next: $wraper.find('.next'),
    })

  var $frame = $('#listenCarousel');
  var $wraper = $frame.parent();
    $frame.sly ({
      horizontal: 1,
      itemNav: 'centered',
      smart:1,
      startAt: 0,
      mouseDragging: 1,
      touchDragging: 1,
      scrollBar: $wraper.find('.scrollbar'),
      scrollbarBy: 1,
      speed: 200,
      dragHandle: 1,
      dynamicHandle: 1,
      clickBar: 1,
      prev: $wraper.find('.prev'),
      next: $wraper.find('.next'),
    })

  var $frame = $('#testCarousel');
  var $wraper = $frame.parent();
    $frame.sly ({
      horizontal: 1,
      itemNav: 'centered',
      smart:1,
      startAt: 0,
      mouseDragging: 1,
      touchDragging: 1,
      scrollBar: $wraper.find('.scrollbar'),
      scrollbarBy: 1,
      speed: 200,
      dragHandle: 1,
      dynamicHandle: 1,
      clickBar: 1,
      prev: $wraper.find('.prev'),
      next: $wraper.find('.next'),
    })

});

$(window).resize(function () {

  adaptive ();

  var $frame = $('#lookCarousel');
  $frame.sly('reload');
  var $frame = $('#playCarousel');
  $frame.sly('reload');
  var $frame = $('#readCarousel');
  $frame.sly('reload');
  var $frame = $('#listenCarousel');
  $frame.sly('reload');
  var $frame = $('#testCarousel');
  $frame.sly('reload');

});

function adaptive () {
  var carousel = $('.frame');
  var width = carousel.innerWidth();
  var win_width = window.innerWidth;

  if (win_width >991) {
      width = width / 3;
  } else if (win_width > 767) {
      width = width / 2;
  }

  var width_inner = Math.floor(width)*6;
  var jcar = document.getElementsByClassName('frame');
  
  for(var i=0; i<jcar.length; i++) elems = jcar[i].getElementsByTagName('article');
  
  for(var i=0; i<jcar.length; i++) {
    for(var j=0; j<elems.length; j++) {
      document.getElementsByClassName('frame')[i].getElementsByTagName('article')[j].style.width = Math.floor(width-40) + 'px';;
    }
  }

  $(".frame-inner").css('width', width_inner + 'px');

  if (win_width >1200) $('collapse in').removeClass('collapse in').addClass('collapse');
}

