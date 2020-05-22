<?php
/* Classes */
include( PLUGIN_PATH . 'classes/post-type.class.php');
include( PLUGIN_PATH . 'classes/visitor.class.php');
include( PLUGIN_PATH . 'classes/enqueue.class.php');
include( PLUGIN_PATH . 'classes/admin-menu.class.php');
include( PLUGIN_PATH . 'classes/easy-include.class.php');
include( PLUGIN_PATH . 'classes/fields.class.php');
include( PLUGIN_PATH . 'classes/encryptor.class.php');

/* Includes Plugin Resources */
Easy_Include::add_folder( PLUGIN_PATH . 'functions/' );
include( PLUGIN_PATH . 'lib/mp-fields/acf.php' ); // Calling the ACF Main Plugin PHP File

add_action( 'init', 'mp_cpt' );
add_action( 'init', 'mp_custom_taxonomy' );

// Enqueues
add_action( 'wp_enqueue_scripts', array( 'MP_Enqueue', 'executePublicEnqueue' ) );
add_action( 'admin_enqueue_scripts', array( 'MP_Enqueue', 'executeAdminEnqueue' ) );
add_action( 'login_enqueue_scripts', array( 'MP_Enqueue', 'executeLoginEnqueue' ) );

// Load ACF Settings
// Define path and URL to the ACF plugin.
add_filter('acf/settings/url', 'my_acf_settings_url');
add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');

// Register Admin Menu
add_action('acf/init', array( 'MP_Admin_Menu', 'execute' ));

// Register Options Settings
add_action('admin_init', 'mp_register_options');

// Remove Admin Notices and Errors
add_action('in_admin_header', 'removeNotices', 1000);

/* External Files */
add_action( 'plugins_loaded', array( 'Easy_Include', 'execute' ) );

/* Helpers */
include( PLUGIN_PATH . 'functions/options/helpers.php');




$files = array_diff( scandir( PLUGIN_PATH . 'add-ons' ), array('..', '.') );
foreach( $files as $file ) {
  if( file_exists( PLUGIN_PATH . 'add-ons/' . $file . '/init.php' ) ) {
    include PLUGIN_PATH . 'add-ons/' . $file . '/init.php';
  }
}

?>
