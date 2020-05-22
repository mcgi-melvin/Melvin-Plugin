<?php

$main_js = array(
  array(
    'name'  =>  'mp-jquery',
    'link'  =>  PLUGIN_URL . 'assets/js/jquery-3.1.1.min.js',
    'type'  =>  'script',
    'after_script'  =>  array(),
    'version' =>  '',
    'position'  =>  false,
  ),
  array(
    'name'  =>  'mp-jquery-ui',
    'link'  =>  PLUGIN_URL . 'assets/js/jquery-ui.min.js',
    'type'  =>  'script',
    'after_script'  =>  array('mp-jquery'),
    'version' =>  '',
    'position'  =>  false,
  ),
  array(
    'name'  =>  'mp-main',
    'link'  =>  PLUGIN_URL . 'assets/js/plugins.js',
    'type'  =>  'script',
    'after_script'  =>  array('mp-jquery'),
    'version' =>  '',
    'position'  =>  true,
    'localize'  =>  array(
      'handle'  =>  'mpAjax',
      'object_name' => array(
        'ajaxurl' => admin_url( 'admin-ajax.php'),
        'site_url' => site_url(),
      )
    )
  )
);

$admin = array(
  array(
    'name'  =>  'mp-admin-style',
    'link'  =>  PLUGIN_URL . 'assets/css/style-admin.css',
    'type'  =>  'style',
  ),
  array(
    'name'  =>  'mp-admin',
    'link'  =>  PLUGIN_URL . 'assets/js/mp_admin.js',
    'type'  =>  'script',
    'after_script'  =>  array('mp-jquery'),
    'version' =>  '',
    'position'  =>  true,
    'localize'  =>  array(
      'handle'  =>  'mpAjax',
      'object_name' => array(
        'ajaxurl' => admin_url( 'admin-ajax.php'),
        'site_url' => site_url(),
      )
    )
  )
);

$public = array(
  /*
  *
  * mp-plugin.css imported
  *
  */
  array(
    'name'  =>  'mp-main',
    'link'  =>  PLUGIN_URL . 'assets/css/style-public.css',
    'type'  =>  'style',
  )
);

$public_enqueue = array_merge( $public, $main_js );
$admin_enqueue = array_merge( $admin, $main_js );
MP_Enqueue::mergePublicEnqueue( $public_enqueue );
MP_Enqueue::mergeAdminEnqueue( $admin_enqueue );

?>
