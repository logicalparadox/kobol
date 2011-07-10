<?php



function kobol_print_webfonts_js() {

  $options = get_option( 'kobol_webfonts_options' );
  
  if ( $options['kobol_webfonts_enabled'] == 1 ):
  ?>
  
  <script type="text/javascript">
    WebFontConfig = {
      google: { families: [ 'Loved+by+the+King' ] }
    };
    (function() {
      var wf = document.createElement('script');
      wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
          '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
      wf.type = 'text/javascript';
      wf.async = 'true';
      var s = document.getElementsByTagName('script')[0];
      s.parentNode.insertBefore(wf, s);
    })();
  </script>
  
  <?php
  endif; // if enabled
}


?>