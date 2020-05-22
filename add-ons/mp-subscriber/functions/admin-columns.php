<?php

// 3.1 Set Up Subscriber Column Header
function mp_subscriber_column_headers( $columns ) {
  $columns = array(
    'cb'  =>  '<input type="checkbox" />',
    'title' =>  __('Name'),
    'email' =>  __('Email Address'),
    'date_subscribe'  =>  __('Date Subscribed')
  );
  unset( $columns['mepr-access'] );
  return $columns;
}

// 3.2 Customizing Column Data
function mp_subscriber_column_data( $column, $post_id ) {
  $output = '';
  switch( $column ) {
    case 'title':
      $fname = get_field( 'mp_subscriber_fname', $post_id );
      $lname = get_field( 'mp_subscriber_lname', $post_id );
      $output .= $fname.' '.$lname;
      break;
    case 'email':
      $email = get_field( 'mp_subscriber_email', $post_id );
      $output .= $email;
      break;
    case 'date_subscribe':
      $output .= get_the_date();
    break;
  }

  echo $output;
}

// 3.3 Changing Column title
// Registers special custom admin title $columns
function mp_register_custom_admin_titles() {
  add_filter(
    'the_title',
    'mp_custom_admin_titles',
    99,
    2
  );
}

// 3.4
function mp_custom_admin_titles( $column, $post_id ) {
  global $post;

  $output = $column;

  if( isset( $post->post_type ) ):

    switch( $post->post_type ) {

      case 'mp_subscriber':
        $fname = get_field( 'mp_subscriber_fname', $post_id );
        $lname = get_field( 'mp_subscriber_lname', $post_id );
        $output = $fname.' '.$lname;
      break;

    }

  endif;


  return $output;
}



?>
