<?php

if ( !defined( 'MP_SUBSCRIBER_PATH' ) ) {
    define( 'MP_SUBSCRIBER_PATH' , plugin_dir_path(__FILE__) );
}

if ( !defined( 'MP_SUBSCRIBER_URL' ) ) {
    define('MP_SUBSCRIBER_URL', plugin_dir_url(__FILE__) );
}

Easy_Include::add_folder( MP_SUBSCRIBER_PATH . 'functions/' );

// Change Column Title
add_action( 'admin_head-edit.php', 'mp_register_custom_admin_titles' );

add_action( 'wp_ajax_nopriv_mp_save_subscription', 'mp_save_subscription' );
add_action( 'wp_ajax_mp_save_subscription', 'mp_save_subscription' );

add_filter( 'manage_edit-mp_subscriber_columns', 'mp_subscriber_column_headers', 99 );
add_filter( 'manage_mp_subscriber_posts_custom_column', 'mp_subscriber_column_data', 1, 2 );
//
add_shortcode('wpp-subscribe-form', 'melvin_subscribe_form');

add_action('acf/init', 'mp_acf_subscriber_fields');
?>
