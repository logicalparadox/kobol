jQuery(function($) {
  $(document).ready(function() {
     var $nav = $('nav#access');
         navOffset = $nav.offset();
     $nav.addClass('sticky-nav');
     
     $(window).scroll(function(){
       if( $(window).scrollTop() >= navOffset.top ) {
         $nav.addClass('stuck');
       } else {
         $nav.removeClass('stuck');
       }
     });
  });
});