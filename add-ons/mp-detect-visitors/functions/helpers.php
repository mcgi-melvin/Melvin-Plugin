<?php

function mp_save_visitor_geo() {
  if( !session_start() ) {
    session_start();
  }

  $data = [];
  $data['session_id'] = session_id();
  $data['ip_address'] = $_POST['ip_address'];
  $data['lat'] = $_POST['lat'];
  $data['lng'] = $_POST['long'];
  $data['country_code'] = $_POST['country_code'];
  $data['country'] = $_POST['country'];
  $data['continent'] = $_POST['continent'];
  $data['timestamp'] = (int)$_POST['time'];

  $visitor = new MP_Visitor();
  $visitor->setData( $data );

  if( $visitor->check_visitor_exist() ) {
    $visitor->update_visitor_timestamp( $visitor->check_visitor_exist()[0]->ID );
    $visitor->update_visitor_status( 'online', $visitor->check_visitor_exist()[0]->ID );
  } else {
    echo json_encode( $visitor->save() );
  }

  echo json_encode( $visitor->check_visitor_exist()[0]->ID );
  exit;
}

function set_visitor_offline() {

  $args = array(
    'post_type' =>  'mp_visitor',
    'posts_per_page'  =>  -1,
    'meta_query'  =>  array(
      /*
      array(
        'key' => 'mp_v_timestamp',
        'value' => array( strtotime('-10 minute'), strtotime( date() ) ),
        'compare' => 'NOT BETWEEN'
      ),
      */
      array(
        'key' => 'mp_v_active_status',
        'value' => 'online',
      ),
    ),
    'date_query' =>array(
      'after' => 'today'
    )
  );

  $posts = get_posts( $args );
  $visitor = new MP_Visitor();
  foreach( $posts as $post ) {
    $current_timestamp = get_field( 'mp_v_timestamp', $post->ID );
    // Check if 5 mins already pass by
    if( round( ( time() - substr( $current_timestamp, 0, -3 ) ) / 60,2 ) >= 5  ) {

      $visitor->update_visitor_status( 'offline', $post->ID );
    }
  }

}

?>
