<?php
/*
Plugin Name: Small Block HTML Area
Plugin URI: https://github.com/Jody-Geers
Description: JJG HTML Block widgit.
Version: 1.0
Author: Jody Jacobus Geers
Author URI: https://github.com/Jody-Geers
License: GPL3
*/
?>
<?php
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