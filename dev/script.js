$(document).ready(function(){
  $('#slider').fadeIn('slow').delay(200);
  $("#sticker").sticky({topSpacing:0});
});

//https://dribbble.com/shots/3581904-HEALTHEX-Day-01

//SMOOTH SCROLL MENU
$(document).ready(function(){
  $("a").on('click', function(event) {
    if (this.hash !== "") {  
      event.preventDefault();

      var hash = this.hash;

      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 1000, function(){
        window.location.hash = hash;
      });
    }
  });
});

//FIXED MENU COLORS
$(document).ready(function(){
  $(window).trigger('scroll');
  $(window).bind('scroll', function () {
    var pixels = 50; //pixeles abajo
    if ($(window).scrollTop() > pixels) {
  $('.nav').addClass('fixed');
      $('.menu a').css({"color":"#354757"});
      $('.logo').css({"color":"#354757"});
    } else {
      $('.nav').removeClass('fixed');
      $('.menu a').css({"color":"#BABCBD"});
      $('.logo').css({"color":"#BABCBD"});
    }
  }); 
}); 

/*
$(document).ready(function(){
  $('a[href^="#"]').on('click',function (e){
    e.preventDefault();
    var target = this.hash;
    var $target = $(target);
    
    //scroll con hash
    $('html, body').animate({
      'scrollTop': $target.offset().top
    }, 1000, 'swing', function(){
      window.location.hash = target;
    });
    
   /* //scroll sin hash
    $('html, body').animte({
      'scrollTop': $targer.offset().top
      }, 1000, 'swing');
  });
});*/