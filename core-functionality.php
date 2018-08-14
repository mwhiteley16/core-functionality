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

//* ACF -- Add options page
//if( function_exists('acf_add_options_page') ) {
//	acf_add_options_page(array(
//		'page_title' 	=> 'Theme Options',
//		'menu_title'	=> 'Theme Options',
//		'menu_slug' 	=> 'theme-options',
//		'capability'	=> 'edit_posts',
//		'position'     => '58.997', // Adds under Genesis options page
//		'icon_url'     => 'dashicons-image-filter', // https://developer.wordpress.org/resource/dashicons/
//		'redirect'	=> false
//	));
//}

//* ACF -- Hide ACF Menu from WordPress Dashboard from everyone except specified user
add_filter( 'acf/settings/show_admin', 'wd_acf_show_admin' );
function wd_acf_show_admin( $show ) {
     $current_user = wp_get_current_user();
     if ( $current_user->user_email == 'matt@whiteleydesigns.com' ){
          return true; // show it
     } else {
          return false; // hide it
     }
}

/**
 * Gravity Forms Domain
 *
 * Adds a notice at the end of admin email notifications
 * specifying the domain from which the email was sent.
 *
 * @param array $notification
 * @param object $form
 * @param object $entry
 * @return array $notification
 */
function wd_gravityforms_domain( $notification, $form, $entry ) {
	if( $notification['name'] == 'Admin Notification' ) {
		$notification['message'] .= 'Sent from ' . home_url();
	}
	return $notification;
}
add_filter( 'gform_notification', 'wd_gravityforms_domain', 10, 3 );
