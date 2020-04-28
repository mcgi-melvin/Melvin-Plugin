<?php
Class MP_PostType {

  private static $post_types = array();

  private static $domain = 'm-plugin';
  /*
  public function __construct($post_type) {
    array_push( self::$post_types, $post_type );
  }
  */

  public static function add_post_type( $post_type ) {
    array_push( self::$post_types, $post_type );
  }

  public static function create() {
    foreach( self::$post_types as $post_type ) {
      if( !post_type_exists( $post_type['post_type'] ) ) {
        register_post_type( $post_type['post_type'], self::args( $post_type ) );
      }
    }
  }

  protected static function label( $post_type ) {
    return array(
  		'name'                  => _x( $post_type['name'].'s', $post_type['name'].'s', self::$domain ),
  		'singular_name'         => _x( $post_type['name'], $post_type['name'], self::$domain ),
  		'menu_name'             => __( $post_type['name'].'s', self::$domain ),
  		'name_admin_bar'        => __( $post_type['name'].'s', self::$domain ),
  		'archives'              => __( $post_type['name'].'s Archive', self::$domain ),
  		'attributes'            => __( $post_type['name'].'s Attributes', self::$domain ),
  		'parent_item_colon'     => __( 'Parent '.$post_type['name'].':', self::$domain ),
  		'all_items'             => __( 'All '.$post_type['name'], self::$domain ),
  		'add_new_item'          => __( 'Add New '.$post_type['name'], self::$domain ),
  		'add_new'               => __( 'Add New', self::$domain ),
  		'new_item'              => __( 'New '.$post_type['name'], self::$domain ),
  		'edit_item'             => __( 'Edit '.$post_type['name'], self::$domain ),
  		'update_item'           => __( 'Update '.$post_type['name'], self::$domain ),
  		'view_item'             => __( 'View '.$post_type['name'], self::$domain ),
  		'view_items'            => __( 'View '.$post_type['name'], self::$domain ),
  		'search_items'          => __( 'Search '.$post_type['name'].'s', self::$domain ),
  		'not_found'             => __( 'Not found', self::$domain ),
  		'not_found_in_trash'    => __( 'Not found in Trash', self::$domain ),
  		'featured_image'        => __( 'Featured Image', self::$domain ),
  		'set_featured_image'    => __( 'Set featured image', self::$domain ),
  		'remove_featured_image' => __( 'Remove featured image', self::$domain ),
  		'use_featured_image'    => __( 'Use as featured image', self::$domain ),
  		'insert_into_item'      => __( 'Insert into '.$post_type['name'], self::$domain ),
  		'uploaded_to_this_item' => __( 'Uploaded to this '.$post_type['name'], self::$domain ),
  		'items_list'            => __( $post_type['name'].'s list', self::$domain ),
  		'items_list_navigation' => __( $post_type['name'].'s list navigation', self::$domain ),
  		'filter_items_list'     => __( 'Filter '.$post_type['name'].' list', self::$domain ),
  	);
  }

  protected static function args( $post_type ) {
     return array(
  		//'label'                 => __( 'Subscribers Categories', self::$domain ),
  		//'description'           => __( 'Subscribers Categories', self::$domain ),
  		'labels'                => self::label( $post_type ),
  		'supports'              => false,
  		'taxonomies'            => isset( $post_type['taxonomies'] ) ? (array)$post_type['taxonomies'] : false,
  		'hierarchical'          => true,
  		'public'                => true,
  		'show_ui'               => true,
  		'show_in_menu'          => isset( $post_type['visibility'] ) ? $post_type['visibility'] : false,
  		'menu_position'         => 99,
  		'show_in_admin_bar'     => true,
  		'show_in_nav_menus'     => true,
  		'can_export'            => true,
  		'has_archive'           => true,
  		'exclude_from_search'   => false,
  		'publicly_queryable'    => true,
  		'capability_type'       => 'post',
  		'menu_icon'							=> $post_type['icon'],
  		'rewrite'								=> array(	'slug'	=>	$post_type['post_type']	),
  		'map_meta_cap' => true
  	);
  }




}


?>
