<?php

if( !function_exists('mp_acf_subscriber_fields') ):

function mp_acf_subscriber_fields() {
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
  ));

  acf_add_local_field(array(
  	'key' => 'field_5e93e55624306',
  	'label' => 'First Name',
  	'name' => 'mp_fname',
  	'type' => 'text',
  	'parent' => 'mp_subscriber_fields'
  ));

  acf_add_local_field(array(
  	'key' => 'field_5e93e56724307',
  	'label' => 'Last Name',
  	'name' => 'mp_lname',
  	'type' => 'text',
  	'parent' => 'mp_subscriber_fields'
  ));

  acf_add_local_field(array(
  	'key' => 'field_5e93e59324308',
  	'label' => 'Email Address',
  	'name' => 'mp_email',
  	'type' => 'email',
  	'parent' => 'mp_subscriber_fields'
  ));

  acf_add_local_field(array(
  	'key' => 'field_5e93e5cc24309',
  	'label' => 'Subscription',
  	'name' => 'mp_subscription',
  	'type' => 'taxonomy',
  	'parent' => 'mp_subscriber_fields',
    'taxonomy' => 'subscriber_list',
  	'field_type' => 'multi_select',
  	'allow_null' => 0,
  	'load_save_terms' 	=> 1,
  	'return_format'		=> 'id',
  	'add_term'			=> 1
  ));
}

endif;

?>
