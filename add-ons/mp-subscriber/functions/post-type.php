<?php
$subscriber = array(
  'name' =>  'WPP Subscriber',
  'post_type' =>  'mp_subscriber',
  'taxonomies' => array( 'subscriber-list' ),
  'icon'  =>  'dashicons-groups',
  'visibility'  =>  true
);
MP_PostType::add_post_type($subscriber);

function mp_custom_taxonomy() {

  $labels = array(
    'name' => _x( 'Subscriber Lists', 'Jobs Categories' ),
    'singular_name' => _x( 'Subscriber List', 'Job Category' ),
    'search_items' =>  __( 'Search List' ),
    'all_items' => __( 'All Lists' ),
    'parent_item' => __( 'Parent List' ),
    'parent_item_colon' => __( 'Parent List:' ),
    'edit_item' => __( 'Edit List' ),
    'update_item' => __( 'Update List' ),
    'add_new_item' => __( 'Add New List' ),
    'new_item_name' => __( 'New Subscriber List Name' ),
    'menu_name' => __( 'Subscriber Lists' ),
  );

  register_taxonomy('subscriber_list',array('mp_subscriber'), array(
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
		'show_in_menu' => true,
    'rewrite' => array( 'slug' => 'subscriber_list' ),
    /*
		'capabilities' => array(
			'manage_terms'  => 'manage_category',
		),*/
  ));
}
?>
