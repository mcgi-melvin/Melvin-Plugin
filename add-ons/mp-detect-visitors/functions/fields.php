<?php

if( !function_exists('mp_acf_guest_fields') ):

function mp_acf_guest_fields() {
  acf_add_local_field_group(array(
  	'key' => 'mp_guest_fields',
  	'title' => 'Guest Details',
  	'fields' => array (),
  	'location' => array (
  		array (
  			array (
  				'param' => 'post_type',
  				'operator' => '==',
  				'value' => 'mp_visitor',
  			),
  		),
  	),
  ));

  acf_add_local_field(array(
  	'key' => 'field_v_session_id',
  	'label' => 'Session ID',
  	'name' => 'mp_v_session_id',
  	'type' => 'text',
  	'parent' => 'mp_guest_fields'
  ));

  acf_add_local_field(array(
  	'key' => 'field_v_ip_address',
  	'label' => 'IP Address',
  	'name' => 'mp_v_ip_address',
  	'type' => 'text',
  	'parent' => 'mp_guest_fields'
  ));

  acf_add_local_field(array(
  	'key' => 'field_v_latitude',
  	'label' => 'Latitude',
  	'name' => 'mp_v_latitude',
  	'type' => 'text',
  	'parent' => 'mp_guest_fields'
  ));

  acf_add_local_field(array(
  	'key' => 'field_v_longitude',
  	'label' => 'longitude',
  	'name' => 'mp_v_longitude',
  	'type' => 'text',
  	'parent' => 'mp_guest_fields'
  ));

  acf_add_local_field(array(
  	'key' => 'field_v_country_code',
  	'label' => 'Country Code',
  	'name' => 'mp_v_country_code',
  	'type' => 'text',
  	'parent' => 'mp_guest_fields'
  ));

  acf_add_local_field(array(
  	'key' => 'field_v_country',
  	'label' => 'Country',
  	'name' => 'mp_v_country',
  	'type' => 'text',
  	'parent' => 'mp_guest_fields'
  ));

  acf_add_local_field(array(
  	'key' => 'field_v_continent',
  	'label' => 'Continent',
  	'name' => 'mp_v_continent',
  	'type' => 'text',
  	'parent' => 'mp_guest_fields'
  ));

  acf_add_local_field(array(
  	'key' => 'field_v_timestamp',
  	'label' => 'TimeStamp',
  	'name' => 'mp_v_timestamp',
  	'type' => 'text',
  	'parent' => 'mp_guest_fields'
  ));

  acf_add_local_field(array(
  	'key' => 'field_v_active_status',
  	'label' => 'Active Status',
  	'name' => 'mp_v_active_status',
  	'type' => 'text',
  	'parent' => 'mp_guest_fields'
  ));
}

endif;

?>
