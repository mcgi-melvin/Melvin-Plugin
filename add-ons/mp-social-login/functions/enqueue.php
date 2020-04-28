<?php

$social_login = array(
  'name'  =>  'mp-social-login',
  'link'  =>  MP_SOCIAL_URL . 'assets/js/social-login.js',
  'type'  =>  'script',
  'after_script'  =>  array('jquery'),
  'version' =>  '',
  'position'  =>  true,
  'user_status' =>  'offline',
  'localize'  =>  array(
    'handle'  =>  'social',
    'object_name' => array(
      'fb_app_id' => get_option('mp_fb_app_id'),
      'fb_sdk_url' => 'https://connect.facebook.net/en_US/sdk.js',
      'google_api_key'  =>  get_option('mp_google_api_key'),
      'google_sdk_url'  =>  'https://apis.google.com/js/platform.js'
    )
  )
);
MP_Enqueue::addPublicEnqueue( $social_login );
MP_Enqueue::addLoginEnqueue( $social_login );

?>
