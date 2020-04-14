<?php
/* Classes */
include( plugin_dir_path( __FILE__ ) . 'classes/post-type.class.php');
include( plugin_dir_path( __FILE__ ) . 'classes/visitor.class.php');

/* Includes */
include( plugin_dir_path( __FILE__ ) . 'functions/acf.php');
include( plugin_dir_path( __FILE__ ) . 'functions/post-types.php');
include( plugin_dir_path( __FILE__ ) . 'functions/shortcodes.php');
include( plugin_dir_path( __FILE__ ) . 'functions/metaboxes.php');

include( plugin_dir_path( __FILE__ ) . 'functions/admin-menus.php');
include( plugin_dir_path( __FILE__ ) . 'functions/subscriber/pages.php');
include( plugin_dir_path( __FILE__ ) . 'functions/visitors/pages.php');


/* 1. Hooks */
// 1.1
add_action( 'init', 'melvin_plugin_shortcodes' );
// 1.2
add_action( 'init', 'mp_cpt' );
add_action( 'init', 'mp_custom_taxonomy' );
// 1.3
add_filter( 'manage_edit-mp_subscriber_columns', 'mp_subscriber_column_headers', 99 );
// 1.4
add_filter( 'manage_mp_subscriber_posts_custom_column', 'mp_subscriber_column_data', 1, 2 );
// 1.5 Change Column Title
add_action( 'admin_head-edit.php', 'mp_register_custom_admin_titles' );
// 1.6 Register Ajax function
add_action( 'wp_ajax_nopriv_mp_save_subscription', 'mp_save_subscription' );
add_action( 'wp_ajax_mp_save_subscription', 'mp_save_subscription' );

add_action( 'wp_ajax_nopriv_mp_save_visitor_geo', 'mp_save_visitor_geo' );
add_action( 'wp_ajax_mp_save_visitor_geo', 'mp_save_visitor_geo' );
// 1.7 Load External Files
add_action( 'wp_enqueue_scripts', 'melvin_plugin_public_enqueues' );
add_action( 'admin_enqueue_scripts', 'melvin_plugin_private_enqueues' );
// 1.8 Load ACF Settings
// Define path and URL to the ACF plugin.
add_filter('acf/settings/url', 'my_acf_settings_url');
add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
// 1.9
// Register Admin Menu
add_action('admin_menu', 'mp_subscriber_admin_menu');

/* 2. Shortcodes */
// 2.1
function melvin_plugin_shortcodes() {
  add_shortcode('mp-form', 'melvin_subscribe_form');
}

/* 3. Filters */
include( plugin_dir_path( __FILE__ ) . 'functions/admin-columns.php');

/* 4. External Files */
include( plugin_dir_path( __FILE__ ) . 'functions/enqueue.php');
require( plugin_dir_path( __FILE__ )  . 'lib/advanced-custom-fields-pro/acf.php' ); // Calling the ACF Main Plugin PHP File


/* 5. Actions */
include( plugin_dir_path( __FILE__ ) . 'functions/subscriber/actions.php');
include( plugin_dir_path( __FILE__ ) . 'functions/visitors/actions.php');

/* 6. Filters */
include( plugin_dir_path( __FILE__ ) . 'functions/subscriber/helpers.php');
include( plugin_dir_path( __FILE__ ) . 'functions/visitors/helpers.php');

?>
