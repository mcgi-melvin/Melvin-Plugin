<?php
define( 'MY_ACF_PATH', PLUGIN_URL . 'lib/mp-fields/' );
define( 'MY_ACF_URL', PLUGIN_URL . 'lib/mp-fields/' );

function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

function my_acf_settings_show_admin( $show_admin ) {
    $option = mp_get_option('mp_toggle_acf');
    if( $option == 'checked' ) {
      return true;
    }
    return false;
}

?>
