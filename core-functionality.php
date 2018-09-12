<?php
   /*
   Plugin Name: Core Functionality Plugin
   Description: DO NOT DEACTIVATE. This plugin controls creation of Custom Post Types (CPTs), taxonomies, shortcodes and other non-theme functionality.  This is a core functionality plugin required for the site to function properly.
   Version: 2.0
   Author: Matt Whiteley
   Author URI: http://www.whiteleydesigns.com
   License: GPL2
   */

// Path to plugin
define( 'WD_PATH', WP_PLUGIN_DIR . '/' . basename( dirname( __FILE__ ) ) );

// Required files
//require_once WD_PATH.'/lib/post-types/post-type-news.php';
//require_once WD_PATH.'/lib/shortcodes/shortcode-news.php';
//require_once WD_PATH.'/lib/taxonomies/taxonomy-news.php';

//* Add CSS to WP admin dashboard
function wd_admin_css() {
    wp_register_style( 'add-admin-stylesheet', plugins_url( '/core-functionality-master/lib/admin/admin-css.css' ) );
    wp_enqueue_style( 'add-admin-stylesheet' );
}
add_action( 'admin_enqueue_scripts', 'wd_admin_css' );
