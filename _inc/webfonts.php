<?php

function kobol_prepare_font_list( $list ) {
  $arry_fonts = preg_split("[\n|\r]", $list);

  foreach($arry_fonts as $key => $value) { 
    if($value == "") { 
      unset($arry_fonts[$key]); 
    } 
  } 
  $arry_fonts = array_values($arry_fonts); 

  foreach($arry_fonts as &$font) {
    $font = str_replace(" ", "+", $font);
    $font = str_replace("[theme_url]", get_bloginfo( 'stylesheet_directory' ), $font); 
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
          google: { families: [ <?php echo kobol_prepare_font_list( $options['kobol_webfonts_gfonts'] ); ?> ] }
        , custom: { families: [ <?php echo kobol_prepare_font_list( $options['kobol_webfonts_cfonts'] ); ?> ],
                        urls: [ <?php echo kobol_prepare_font_list( $options['kobol_webfonts_cfonts_css'] ); ?> ] }
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