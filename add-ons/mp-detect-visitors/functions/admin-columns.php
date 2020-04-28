<?php

// 3.5 Set Up Visitor Column Header
function mp_visitor_column_headers( $columns ) {
  $columns = array(
    'cb'  =>  '<input type="checkbox" />',
    'title' =>  __('Title'),
    'session' =>  __('Session ID'),
    'status' =>  __('Status'),
  );
  unset( $columns['mepr-access'] );
  return $columns;
}

// 3.6 Customizing Column Data
function mp_visitor_column_data( $column, $post_id ) {
  $output = '';
  switch( $column ) {
    case 'title':
      $output .= get_the_title( $post_id );
      break;
    case 'session':
      $output .= get_field( 'mp_v_session_id', $post_id );
      break;
    case 'status':
      $output .= get_field( 'mp_v_active_status', $post_id );
      break;
  }

  echo $output;
}



?>
