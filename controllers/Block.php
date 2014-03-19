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

class Block {
    
    
    
    /*
    * returns the block wrapper
    */
    private function _getView ($pluginGlobalArgs) { 
        return $pluginGlobalArgs['pluginBaseDir'] . 'views/block/main-layout.php'; 
    }

    
    
    /*
    * Creates a view from snippets
    */
    public function setView ($pluginGlobalArgs, $args) {         
        // create view
        return str_replace("%HTML%", $args['htmlContent'], $pluginGlobalArgs['binHtmlTools']->getStringHTML(array(
            'location' => self::_getView($pluginGlobalArgs)
        )));
    }
}
?>
