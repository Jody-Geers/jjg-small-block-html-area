<?php
/*
Plugin Name: Small Block HTML Area
Plugin URI: https://github.com/Jody-Geers
Description: JJG HTML Block widgit.
Version: 1.0
Author: Jody Jacobus Geers
Author URI: http://jody-geers.github.io/
License: GPL3
*/
?>
<?php
/*
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/
?>
<?php
// Main() - Bring tha noise!
class jjg_small_block_html_area extends WP_Widget {
    
    // shared globals throughout app
    private static $pluginGlobalArgs;
    
    
    
    /*
    * This constructor function initializes the widget
    */
    function jjg_small_block_html_area () {
        // set up app modules
        include "bin/HtmlTools.php";
        include "controllers/Block.php";

        self::$pluginGlobalArgs = array(
            'pluginBaseDir' => plugin_dir_path(__FILE__),
            'pluginBaseUrl' => plugin_dir_url(__FILE__),
            'binHtmlTools' => new JJG_HTML_BLOCK\HtmlTools,
            'controllerBlock' => new JJG_HTML_BLOCK\Block
        );
        
        $widget_options = array(
            'classname' => 'jjg_small_block_html_area',
            'description' => __('Custom display of HTML block') 
        );
        
        // Call the parent class WP_Widget
        parent::WP_Widget('jjg_small_block_html_area', 'JJG Small Block HTML Area', $widget_options);
    }

    
    
    /*
    *  Outputs the contents of the widget
    */
    function widget ($args, $instance) {
        // Splits arguments out and makes them local variables. EXTR_SKIP protects any already created local variables
        extract( $args, EXTR_SKIP );

        // Here if a title is set use it. If not use the default title
        $title = ( $instance['title'] ) ? $instance['title'] : "HTML";
        $htmlContent = ( $instance['htmlContent'] ) ? $instance['htmlContent'] : "";
        
        // styles
        wp_register_style( 'jjg_small_block_html_area_css', self::$pluginGlobalArgs['pluginBaseUrl'] . "build/css.css");
        wp_enqueue_style('jjg_small_block_html_area_css');
        // lekke sticky javascript
        wp_register_script( 'jjg_small_block_html_area_js', self::$pluginGlobalArgs['pluginBaseUrl'] . "build/js.js");
        wp_enqueue_script('jjg_small_block_html_area_js');
        
        // $before_widget, $after_widget, etc are used for theme compatibility
        echo $before_widget;
        echo $before_title . $title . $after_title;
        
        echo self::$pluginGlobalArgs['controllerBlock']->setView(self::$pluginGlobalArgs, array(
            'htmlContent' => $instance['htmlContent']
        ));
        
        //$plugin_image = plugins_url( 'images/image.png' , __FILE__ ); echo $plugin_image;
        
        echo $after_widget;
    }
    
    
    
    /*
    * Pass the new widget values contained in $new_instance and update saves everything for you
    */
    function update ($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['htmlContent'] = $new_instance['htmlContent'];

        return $instance;
    }

 

    /*
     *  Displays options in the widget admin section of site
     */
    function form($instance) {
        // Set all of the default values for the widget
        $defaults = array( 'title' => '', 'htmlContent' => '');

        // Grab any widget values that have been saved and merge them into an array with wp_parse_args
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = $instance['title'];
        $htmlContent = $instance['htmlContent'];
        
        include "views/config/form.php";
    }

    
    
}



// Registers a new widget to be used in your WordPress theme
function jjg_small_block_html_area_init () {
    register_widget('jjg_small_block_html_area');
}

 

// Attaches a rule that tells wordpress to call my function when widgets are initialized
add_action('widgets_init', 'jjg_small_block_html_area_init');
?>

