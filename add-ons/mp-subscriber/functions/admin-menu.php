<?php
/*
add_action('admin_menu', 'mp_subscriber_admin_menu');
function mp_subscriber_admin_menu() {
  $top_menu_item = 'mp_subscriber_admin_page';

  add_menu_page('', 'MP Subscribers', 'manage_options', $top_menu_item, '_mp_subscriber_redirect', 'dashicons-groups');

  add_submenu_page( $top_menu_item, '', 'MP Subscribers', 'MP Subscribers', 'manage_options', 'edit.php?post_type=mp_subscriber', $top_menu_item );
  add_submenu_page( $top_menu_item, 'Subscriber List', 'Subscriber List', 'manage_options', 'edit-tags.php?taxonomy=subscriber_list&post_type=mp_subscriber' );
  add_submenu_page( $top_menu_item, '', 'Options', 'manage_options', 'mp_option_subscribe_page', 'mp_option_subscribe_page', 999 );

}
*/

$parent_slug = 'mp_subscriber_setting_page';

$mp_subscriber_menu = array(
  'page_title' 	=> 'Settings',
  'menu_title'	=> 'Settings',
  'parent_slug' => 'edit.php?post_type=mp_subscriber',
  'menu_slug' 	=> $parent_slug,
  'capability'	=> 'manage_options',
  'redirect'		=> false,
);

MP_Admin_Menu::add_menu( $mp_subscriber_menu );

?>
