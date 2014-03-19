<?php
/*
Plugin Name: Small Block HTML Area
Plugin URI: https://github.com/Jody-Geers/jjg-small-block-html-area
Description: JJG HTML Block widgit.
Version: 1.0
Author: Jody Jacobus Geers
Author URI: http://jody-geers.github.io/
License: GPL3
*/
?>
<?php

namespace JJG_HTML_BLOCK;

class HtmlTools {
    
    
    
    /*
    * takes a php file location, returns string for variable.
    */
    public function getStringHTML ($args) {
        ob_start();
        include $args['location'];
        return ob_get_clean();
    }
}
?>
