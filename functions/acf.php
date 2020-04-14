<?php
define( 'MY_ACF_PATH', PLUGIN_PATH . 'lib/advanced-custom-fields-pro/' );
define( 'MY_ACF_URL', PLUGIN_PATH . 'lib/advanced-custom-fields-pro/' );

function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

function my_acf_settings_show_admin( $show_admin ) {
    return false;
}

?>
