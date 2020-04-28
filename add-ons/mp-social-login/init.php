<?php

if ( !defined( 'MP_SOCIAL_PATH' ) ) {
    define( 'MP_SOCIAL_PATH' , plugin_dir_path(__FILE__) );
}

if ( !defined( 'MP_SOCIAL_URL' ) ) {
    define('MP_SOCIAL_URL', plugin_dir_url(__FILE__) );
}

//Easy_Include::add_folder( MP_SOCIAL_PATH . 'includes/facebook/vendor/' );
Easy_Include::add_folder( MP_SOCIAL_PATH . 'functions/' );

add_shortcode('wpp-social-login', 'mp_social_shortcode');

// 1.6 Register Ajax function
add_action( 'wp_ajax_nopriv_mp_create_user_account', 'mp_create_user_account' );
?>
