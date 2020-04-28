<?php
/*
function mp_admin_menu() {
  $top_menu_item = 'mp_dashboard_admin_page';

  add_menu_page('', 'MP Dashboard', 'manage_options', 'mp_dashboard_admin_page', 'mp_dashboard_admin_page', 'dashicons-mp');

  add_submenu_page( $top_menu_item, '', 'Dashboard', 'Dashboard', 'manage_options', $top_menu_item, $top_menu_item );

  add_submenu_page( $top_menu_item, '', 'Visitors', 'manage_options', 'edit.php?post_type=mp_visitor' );
  add_submenu_page( $top_menu_item, '', 'Options', 'manage_options', 'mp_option_admin_page', 'mp_option_admin_page', 999 );

}
*/

$parent_slug = 'mp_dashboard_admin_page';

$mp_parent_menu = array(
  'page_title' 	=> 'Wordpress Power Package',
  'menu_title'	=> 'WP Power Package',
  'menu_slug' 	=> $parent_slug,
  'capability'	=> 'manage_options',
  'redirect'		=> false,
  'icon_url'    => 'dashicons-mp',
  'position'    => 99
);

$mp_child_option_submenu = array(
    'page_title'  => __('WP Power Package Settings'),
    'menu_title'  => __('Settings'),
    'parent_slug' => $parent_slug,
);

MP_Admin_Menu::add_menu( $mp_parent_menu );
MP_Admin_Menu::add_sub_menu( $mp_child_option_submenu );



?>
