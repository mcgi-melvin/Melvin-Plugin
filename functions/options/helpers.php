<?php

function mp_get_page_select( $input_name = "mp_page", $input_id, $parent=-1, $value_field="id", $selected_value="" ) {
  $pages = get_pages( array(
      'sort_order'  =>  'asc',
      'sort_column' =>  'post_title',
      'post_type' =>  'page',
      'parent'  =>  $parent,
      'status'  =>  'publish'
  ) );

  $select = "select name='$input_name' ";

  if( strlen( $input_id ) ) {
    $select .= "id='$input_id'";
  }
  // Set first select option
  $select .= "><option value=''>- Select One - </option>";

  foreach( $pages as $page ) :

    $value = $page->ID;

    switch( $value_field ) {
      case 'slug':
        $value = $page->post_name;
        break;
      case 'url':
        $value = get_page_link( $page->ID );
        break;
      default:
        $value = $page->ID;
    }

    $selected = '';
    if( $selected_value == $value ) {
      $selected = ' selected';
    }

    $option = "<option value='$value' $selected>";
    $option .= $page->post_title;
    $option .= "</option>";

  endforeach;

  $select .= '</select>';

  return $select;
}

function mp_get_default_options() {
  $defaults = [];

  $front_page_id = get_option('page_on_front');

  $defaults = array(
    'mp_toggle_acf' =>  '',
  );


  return $defaults;
}

function mp_get_option( $option_name ) {

  $option_value = "";

  try {
    $defaults = mp_get_default_options();

    $option_value = (get_option( $option_name )) ?  get_option( $option_name ) : $defaults[$option_name];

  } catch ( Exception $e ) {

  }

  return $option_value;

}

function mp_get_current_options() {

  $current_options = array();

  try {

    $current_options = array(
      'mp_toggle_acf' =>  mp_get_option('mp_toggle_acf'),
    );

  }catch( Exception $e ) {

  }

  return $current_options;

}

function mp_checkbox_value( $field ) {
  $value = '';

  $option = mp_get_option( $field );
  if( empty( $option ) ) {
    $value = 'checked';
  }

  return $value;
}

function mp_checkbox_status( $field ) {
  $status = '';

  $option = mp_get_option( $field );
  if( $option ) {
    $status = 'checked';
  }

  return $status;
}


?>
