<?php
Class PostType {

  private $post_type;

  private $domain = 'm-plugin';

  public function __construct($post_type) {
    $this->post_type = $post_type;
  }

  public function create() {
    if( !post_type_exists( $this->post_type['post_type'] ) ) {
      register_post_type( $this->post_type['post_type'], $this->args( $this->post_type ) );
    }
  }

  protected function label( $post_type ) {
    return array(
  		'name'                  => _x( $post_type['name'].'s', $post_type['name'].'s', $this->domain ),
  		'singular_name'         => _x( $post_type['name'], $post_type['name'], $this->domain ),
  		'menu_name'             => __( $post_type['name'].'s', $this->domain ),
  		'name_admin_bar'        => __( $post_type['name'].'s', $this->domain ),
  		'archives'              => __( $post_type['name'].'s Archive', $this->domain ),
  		'attributes'            => __( $post_type['name'].'s Attributes', $this->domain ),
  		'parent_item_colon'     => __( 'Parent '.$post_type['name'].':', $this->domain ),
  		'all_items'             => __( 'All '.$post_type['name'], $this->domain ),
  		'add_new_item'          => __( 'Add New '.$post_type['name'], $this->domain ),
  		'add_new'               => __( 'Add New', $this->domain ),
  		'new_item'              => __( 'New '.$post_type['name'], $this->domain ),
  		'edit_item'             => __( 'Edit '.$post_type['name'], $this->domain ),
  		'update_item'           => __( 'Update '.$post_type['name'], $this->domain ),
  		'view_item'             => __( 'View '.$post_type['name'], $this->domain ),
  		'view_items'            => __( 'View '.$post_type['name'], $this->domain ),
  		'search_items'          => __( 'Search '.$post_type['name'].'s', $this->domain ),
  		'not_found'             => __( 'Not found', $this->domain ),
  		'not_found_in_trash'    => __( 'Not found in Trash', $this->domain ),
  		'featured_image'        => __( 'Featured Image', $this->domain ),
  		'set_featured_image'    => __( 'Set featured image', $this->domain ),
  		'remove_featured_image' => __( 'Remove featured image', $this->domain ),
  		'use_featured_image'    => __( 'Use as featured image', $this->domain ),
  		'insert_into_item'      => __( 'Insert into '.$post_type['name'], $this->domain ),
  		'uploaded_to_this_item' => __( 'Uploaded to this '.$post_type['name'], $this->domain ),
  		'items_list'            => __( $post_type['name'].'s list', $this->domain ),
  		'items_list_navigation' => __( $post_type['name'].'s list navigation', $this->domain ),
  		'filter_items_list'     => __( 'Filter '.$post_type['name'].' list', $this->domain ),
  	);
  }

  protected function args( $post_type ) {
     return array(
  		//'label'                 => __( 'Subscribers Categories', $this->domain ),
  		//'description'           => __( 'Subscribers Categories', $this->domain ),
  		'labels'                => $this->label( $post_type ),
  		'supports'              => false,
  		'taxonomies'            => isset( $post_type['taxonomies'] ) ? (array)$post_type['taxonomies'] : false,
  		'hierarchical'          => true,
  		'public'                => true,
  		'show_ui'               => true,
  		'show_in_menu'          => false,
  		'menu_position'         => 5,
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
