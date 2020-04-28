<?php
// Add custom settings here
function mp_register_options() {
  // plugin options
  register_setting('mp_plugin_options', 'mp_toggle_acf');
  register_setting('mp_plugin_options', 'mp_fb_app_id');
  register_setting('mp_plugin_options', 'mp_google_api_key');
}

?>
