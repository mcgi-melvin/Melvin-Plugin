<?php
if ( ! function_exists('melvin_plugin_public_enqueues') ) :

function melvin_plugin_public_enqueues(){

  wp_register_style('mp-main-css', PLUGIN_URL . 'assets/css/style.css');
  wp_enqueue_style('mp-main-css');

  wp_register_script('mp-jquery', PLUGIN_URL . 'assets/js/jquery-3.1.1.min.js', null, null, true);
  wp_enqueue_script('mp-jquery');

  wp_register_script('mp-main-js', PLUGIN_URL . 'assets/js/plugins.js', array('mp-jquery'), null, true);
  wp_localize_script( 'mp-main-js', 'mpAjax', array(
    'ajaxurl' => admin_url( 'admin-ajax.php'),
    'site_url' => site_url(),
  ));
  wp_enqueue_script('mp-main-js');

  wp_register_script('mp-subscriber-js', PLUGIN_URL . 'assets/js/subscriber.js', array('mp-main-js'), null, true);
  wp_enqueue_script('mp-subscriber-js');

  wp_register_script('mp-location-js', PLUGIN_URL . 'assets/js/location.js', array('mp-main-js'), null, true);
  wp_enqueue_script('mp-location-js');

}

endif;

if ( ! function_exists('melvin_plugin_private_enqueues') ) :

function melvin_plugin_private_enqueues(){

  wp_register_script('mp-admin-js', PLUGIN_URL . 'assets/js/mp_admin.js', array('jquery'), null, true);
  wp_localize_script( 'mp-admin-js', 'mpAjax', array(
    'ajaxurl' => admin_url( 'admin-ajax.php'),
    'site_url' => site_url(),
  ));
  wp_enqueue_script('mp-admin-js');


}

endif;

?>
