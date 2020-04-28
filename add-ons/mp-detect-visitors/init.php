<?php

if ( !defined( 'MP_VISITOR_PATH' ) ) {
    define( 'MP_VISITOR_PATH' , plugin_dir_path(__FILE__) );
}

if ( !defined( 'MP_VISITOR_URL' ) ) {
    define('MP_VISITOR_URL', plugin_dir_url(__FILE__) );
}

Easy_Include::add_folder( MP_VISITOR_PATH . 'functions/' );

add_filter( 'manage_edit-mp_visitor_columns', 'mp_visitor_column_headers', 99 );
add_filter( 'manage_mp_visitor_posts_custom_column', 'mp_visitor_column_data', 1, 2 );

add_action( 'wp_ajax_nopriv_mp_save_visitor_geo', 'mp_save_visitor_geo' );
add_action( 'wp_ajax_mp_save_visitor_geo', 'mp_save_visitor_geo' );

// Auto Update Visitor Status to Offline
add_action( 'init', 'set_visitor_offline', 1000 );

add_action('acf/init', 'mp_acf_guest_fields');

?>
