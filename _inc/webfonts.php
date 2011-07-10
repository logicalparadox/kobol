<?php

function kobol_prepare_gfont_list() {
  $options = get_option( 'kobol_webfonts_options' );
  
  $arry_fonts = preg_split("[\n|\r]", $options['kobol_webfonts_gfonts']);

  foreach($arry_fonts as $key => $value) { 
    if($value == "") { 
      unset($arry_fonts[$key]); 
    } 
  } 
  $arry_fonts = array_values($arry_fonts); 

  foreach($arry_fonts as &$font) {
    $font = str_replace(" ", "+", $font);
  }
  $fonts = "'" . join("', '", $arry_fonts) . "'"; 

  return $fonts;
}

function kobol_print_webfonts_js() {

  $options = get_option( 'kobol_webfonts_options' );
  
  if ( $options['kobol_webfonts_enabled'] == 1 ):
    ?>
    <script type="text/javascript">
      WebFontConfig = {
        google: { families: [ <?php echo kobol_prepare_gfont_list(); ?> ] }
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