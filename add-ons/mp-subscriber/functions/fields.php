<?php

if( !function_exists('mp_acf_subscriber_fields') ):

function mp_acf_subscriber_fields() {

  /*
  *
  * Subscriber Post type Fields
  *
  */
  acf_add_local_field_group(array(
  	'key' => 'mp_subscriber_fields',
  	'title' => 'Subscriber Details',
  	'fields' => array (),
  	'location' => array (
  		array (
  			array (
  				'param' => 'post_type',
  				'operator' => '==',
  				'value' => 'mp_subscriber',
  			),
  		),
  	),
    'style' =>  'seamless',
    'label_placement' =>  'left'
  ));

  if( get_field( 'mp_use_fullname', 'option' ) ) {

    acf_add_local_field(array(
    	'key' => 'mp_subscriber_fullname',
    	'label' => 'Full Name',
    	'name' => 'mp_subscriber_fullname',
    	'type' => 'text',
    	'parent' => 'mp_subscriber_fields'
    ));

  } else {

    acf_add_local_field(array(
    	'key' => 'field_5e93e55624306',
    	'label' => 'First Name',
    	'name' => 'mp_subscriber_fname',
    	'type' => 'text',
    	'parent' => 'mp_subscriber_fields'
    ));

    acf_add_local_field(array(
    	'key' => 'field_5e93e56724307',
    	'label' => 'Last Name',
    	'name' => 'mp_subscriber_lname',
    	'type' => 'text',
    	'parent' => 'mp_subscriber_fields'
    ));

  }


  acf_add_local_field(array(
  	'key' => 'field_5e93e59324308',
  	'label' => 'Email Address',
  	'name' => 'mp_subscriber_email',
  	'type' => 'email',
  	'parent' => 'mp_subscriber_fields'
  ));

  acf_add_local_field(array(
  	'key' => 'field_5e93e5cc24309',
  	'label' => 'Subscription',
  	'name' => 'mp_subscriber_subscription',
  	'type' => 'taxonomy',
  	'parent' => 'mp_subscriber_fields',
    'taxonomy' => 'subscriber_list',
  	'field_type' => 'multi_select',
  	'allow_null' => 0,
  	'load_save_terms' 	=> 1,
  	'return_format'		=> 'object',
  	'add_term'			=> 1
  ));


  /*
  *
  * Add Additional field to the edit post
  *
  */

  if( is_admin() && isset( $_GET['post'] ) ) {
    $id = (int)$_GET['post'];
    $post = get_post( $id );
    $ignore_keys = ['mp_subscriber_subscription' , 'mp_subscriber_email', 'mp_subscriber_lname', 'mp_subscriber_fname', 'mp_subscriber_fullname'];
    if( $post->post_type !== 'mp_subscriber' ) {
      return false;
    }
    $post_meta = get_post_meta( $id );
    foreach( $post_meta as $key => $meta ) {
      /*
      *
      * Skip other meta keys than mp_subscriber_*
      *
      */
      if( strpos( $key, 'mp_subscriber' ) !== 0 ) {
        continue;
      }
      /*
      *
      * Ignore key if is in $ignore_keys
      *
      */
      if( in_array( $key, $ignore_keys ) ) {
        continue;
      }

      $title = ucfirst( str_replace( 'mp_subscriber_', '', $key ) );

      acf_add_local_field(array(
      	'key' => $key,
      	'label' => $title,
      	'name' => $key,
      	'type' => 'text',
      	'parent' => 'mp_subscriber_fields'
      ));

    }
  }




  acf_add_local_field_group(array(
  	'key' => 'group_5ec5a88fd1697',
  	'title' => 'WPP Subscriber Settings',
  	'fields' => array(
  		array(
  			'key' => 'field_5ec5a8cd3fd55',
  			'label' => 'General',
  			'name' => '',
  			'type' => 'tab',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'placement' => 'top',
  			'endpoint' => 0,
  		),
  		array(
  			'key' => 'field_5ec5ab8bb8f71',
  			'label' => 'Shortcodes',
  			'name' => '',
  			'type' => 'message',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'message' => 'Use this shortcode to display the subscription form
  [wpp-subscribe-form]

  To display manage subscription
  [wpp-manage-subscription]',
  			'new_lines' => 'wpautop',
  			'esc_html' => 0,
  		),
  		array(
  			'key' => 'field_5ec5a8d93fd56',
  			'label' => 'Fields',
  			'name' => '',
  			'type' => 'tab',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'placement' => 'top',
  			'endpoint' => 0,
  		),
  		array(
  			'key' => 'field_5ec5a92b98ca8',
  			'label' => 'Form Additional Fields',
  			'name' => 'mp_subscriber_additional_fields',
  			'type' => 'repeater',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'collapsed' => '',
  			'min' => 0,
  			'max' => 0,
  			'layout' => 'block',
  			'button_label' => 'Add Field',
  			'sub_fields' => array(
  				array(
  					'key' => 'field_5ec5a9f798ca9',
  					'label' => 'Label',
  					'name' => 'label',
  					'type' => 'text',
  					'instructions' => '',
  					'required' => 1,
  					'conditional_logic' => 0,
  					'wrapper' => array(
  						'width' => '',
  						'class' => '',
  						'id' => '',
  					),
  					'default_value' => '',
  					'placeholder' => '',
  					'prepend' => '',
  					'append' => '',
  					'maxlength' => '',
  				),
  				array(
  					'key' => 'field_5ec5aa0098caa',
  					'label' => 'Type',
  					'name' => 'type',
  					'type' => 'select',
  					'instructions' => '',
  					'required' => 0,
  					'conditional_logic' => 0,
  					'wrapper' => array(
  						'width' => '',
  						'class' => '',
  						'id' => '',
  					),
  					'choices' => array(
  						'text' => 'Text',
  						'number' => 'Number',
  						'email' => 'Email',
  						'url' => 'Url',
  						'select' => 'Select',
  					),
  					'default_value' => array(
  					),
  					'allow_null' => 0,
  					'multiple' => 0,
  					'ui' => 0,
  					'return_format' => 'value',
  					'ajax' => 0,
  					'placeholder' => '',
  				),
  				array(
  					'key' => 'field_5ec5aa0498cab',
  					'label' => 'Placeholder',
  					'name' => 'placeholder',
  					'type' => 'text',
  					'instructions' => '',
  					'required' => 0,
  					'conditional_logic' => 0,
  					'wrapper' => array(
  						'width' => '',
  						'class' => '',
  						'id' => '',
  					),
  					'default_value' => '',
  					'placeholder' => '',
  					'prepend' => '',
  					'append' => '',
  					'maxlength' => '',
  				),
  				array(
  					'key' => 'field_5ec5aa5a98cac',
  					'label' => 'Selections',
  					'name' => 'selections',
  					'type' => 'repeater',
  					'instructions' => '',
  					'required' => 0,
  					'conditional_logic' => array(
  						array(
  							array(
  								'field' => 'field_5ec5aa0098caa',
  								'operator' => '==',
  								'value' => 'select',
  							),
  						),
  					),
  					'wrapper' => array(
  						'width' => '',
  						'class' => '',
  						'id' => '',
  					),
  					'collapsed' => '',
  					'min' => 0,
  					'max' => 0,
  					'layout' => 'table',
  					'button_label' => 'Add Choices',
  					'sub_fields' => array(
  						array(
  							'key' => 'field_5ec5ad60acefd',
  							'label' => 'Label',
  							'name' => 'label',
  							'type' => 'text',
  							'instructions' => '',
  							'required' => 0,
  							'conditional_logic' => 0,
  							'wrapper' => array(
  								'width' => '',
  								'class' => '',
  								'id' => '',
  							),
  							'default_value' => '',
  							'placeholder' => '',
  							'prepend' => '',
  							'append' => '',
  							'maxlength' => '',
  						),
  					),
  				),
  			),
  		),
  		array(
  			'key' => 'field_5ec5a8e43fd57',
  			'label' => 'Settings',
  			'name' => '',
  			'type' => 'tab',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'placement' => 'top',
  			'endpoint' => 0,
  		),
  	),
  	'location' => array(
  		array(
  			array(
  				'param' => 'options_page',
  				'operator' => '==',
  				'value' => 'acf-options-mp_subscriber_setting_page',
  			),
  		),
  	),
  	'menu_order' => 0,
  	'position' => 'normal',
  	'style' => 'seamless',
  	'label_placement' => 'left',
  	'instruction_placement' => 'label',
  	'hide_on_screen' => '',
  	'active' => true,
  	'description' => '',
  ));

}

endif;






?>
