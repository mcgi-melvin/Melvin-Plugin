<?php
function mp_subscriber_admin_menu() {
  $top_menu_item = 'mp_dashboard_admin_page';

  add_menu_page('', 'Melvin Plugin', 'manage_options', 'mp_dashboard_admin_page', 'mp_dashboard_admin_page', 'dashicons-email-alt');

  add_submenu_page( $top_menu_item, '', 'Dashboard', 'Dashboard', 'manage_options', $top_menu_item, $top_menu_item );
  add_submenu_page( $top_menu_item, '', 'Subscribers', 'manage_options', 'edit.php?post_type=mp_subscriber' );
  add_submenu_page( $top_menu_item, '', 'Visitors', 'manage_options', 'edit.php?post_type=mp_visitor' );
  add_submenu_page( $top_menu_item, '', 'Plugin Options', 'manage_options', 'mp_option_admin_page', 'mp_option_admin_page' );

}


?>
