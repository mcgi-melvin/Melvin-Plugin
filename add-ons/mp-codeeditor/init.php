<?php

/*
*
* Wordpress Power Package Add-On - Code Editor
*
*
*/

define('CE_ADDON_NAME', 'WPP Code Editor');

if ( !defined( 'MP_CODEEDITOR_PATH' ) ) {
    define( 'MP_CODEEDITOR_PATH' , plugin_dir_path(__FILE__) );
}

if ( !defined( 'MP_CODEEDITOR_URL' ) ) {
    define('MP_CODEEDITOR_URL', plugin_dir_url(__FILE__) );
}

if ( !defined( 'MP_CSS_FOLDER_OUTPUT' ) ) {
    define('MP_CSS_FOLDER_OUTPUT', MP_CODEEDITOR_PATH . 'assets/css/output/' );
}

if ( !defined( 'MP_CSS_FOLDER_OUTPUT_URI' ) ) {
    define('MP_CSS_FOLDER_OUTPUT_URI', MP_CODEEDITOR_URL . 'assets/css/output/' );
}


//add_action( 'admin_menu', 'wpp_codeeditor_register_menu_page' );

Easy_Include::add_folder( MP_CODEEDITOR_PATH . 'functions/' );

?>
