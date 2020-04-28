<?php

// 6.1
function mp_subscriber_has_subscription( $subscriber_id, $list_id ) {

  //Setup Default Return value
  $has_subscription = false;

  // Get Subscriber
  $subscriber = get_post( $subscriber_id );

  // Get Subscription
  $subscription = mp_get_subscriptions( $subscriber_id );

  //check subscription for $list_id
  if( in_array( $list_id, $subscription ) ) {
    // Found the $list_id in $subscription
    // This Subscriber is already subscribed to this list
    $has_subscription = true;
  }

  return $has_subscription;

}

// 6.2 Get subscriber id from an email
function mp_get_subscriber_id( $email ) {
  $subscriber_id = 0;
  try {
    // Check if subscriber already exist
    $args = array(
      'post_type' =>  'mp_subscriber',
      'posts_per_page'  => 1,
      'meta_key'  =>  'mp_email',
      'meta_value'  =>  $email
    );
    $subscriber_query = new WP_Query( $args );

    if( $subscriber_query->have_posts() ):
      $subscriber_query->the_post();
      $subscriber_id = get_the_ID();
    endif;
  } catch ( Exception $e ) {

  }
  wp_reset_query();
  return (int)$subscriber_id;
}

// 6.3
//
function mp_get_subscriptions( $subscriber_id ) {
  $subscriptions = [];

  // get subscriptions (return array of list objects)
  $lists = get_field( 'mp_subscription', $subscriber_id );

  // If $lists returns something
  if( $lists ):

    if( is_array( $lists ) && count( $lists ) > 0 ):
      foreach( $lists as &$list ){
        $subscriptions[] = (int)$list->term_id;
      }
    elseif( is_numeric( $lists ) ):
      $subscriptions[] = $lists;
    endif;

  endif;

  return $subscriptions;
}

// 6.4
function mp_get_subscriber_data( $subscriber_id ) {
  // Setup Subscriber Data
  $subscriber_data = array();

  $subscriber = get_post( $subscriber_id );

  // Check if subscriber object is valid
  if( isset( $subscriber->post_type ) && $subscriber->post_type == 'mp_subscriber' ) {

    $subscriber_data = array(
      'name'  =>  get_field( 'mp_fname', $subscriber_id ) .' '. get_field( 'mp_lname', $subscriber_id ),
      'fname' =>  get_field( 'mp_fname', $subscriber_id ),
      'lname' =>  get_field( 'mp_lname', $subscriber_id ),
      'email' =>  get_field( 'mp_email', $subscriber_id ),
      'subscriptions' => mp_get_subscriptions( $subscriber_id ),
    );

  }

}



?>
