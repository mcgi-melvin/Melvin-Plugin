<?php

/*
*
* 6.0
* Create a new subscriber or update an existing one
*
*/
function mp_save_subscriber( $subscriber_data ) {
  $result = [];
  /*
  *
  * Setup default subscriber id
  * 0 means the subscriber will be not save
  *
  */
  $subscriber_id = 0;
  /*
  * List of meta keys that will skip
  */
  $skip_meta = [ 'mp_subscriber_subscription', 'mp_subscriber_list' ];

  try {

    $subscriber_id = mp_get_subscriber_id( $subscriber_data['mp_subscriber_email'] );
    if( $subscriber_id == 0 ):
      /*
      *
      * Create new post with mp_subscriber post_type
      * return data stored as $subscriber_id
      *
      */
      $subscriber_id = wp_insert_post(
        array(
          'post_type' =>  'mp_subscriber',
          'post_title'  =>  get_field( 'mp_subscriber_fullname', 'option' ) == true ? $subscriber_data['mp_subscriber_fullname'] : $subscriber_data['mp_subscriber_fname'] .' '. $subscriber_data['mp_subscriber_lname'],
          'post_status' =>  'publish',
        ),
        true
      );

      /*
      * Add/Update Custom Meta Data
      */
      foreach( $subscriber_data as $i => $data ) {
        /*
        * Skip keys that match with $skip_meta
        */
        if( in_array( $i, $skip_meta ) ) {
          continue;
        }
        update_field( $i, $data, $subscriber_id );
      }

    endif;

  } catch ( Exception $e ) {
    $result['message'] = 'Caught Exception: '. $e->getMessage();
  }

  wp_reset_query();
  return $subscriber_id;
}

/*
*
* 6.1
* Check whether the subscriber has subsription ( $list_id )
* Accept parameter $subscriber_id and $list_id
*
*/
function mp_subscriber_has_subscription( $subscriber_id, $list_id ) {

  //Setup Default Return value
  $has_subscription = false;

  // Get Subscriber
  $subscriber = get_post( $subscriber_id );

  // Get Subscription
  $subscriptions = mp_get_subscriptions( $subscriber_id );

  //check subscription for $list_id
  if( in_array( $list_id, $subscriptions ) ) {
    /*
    *
    * Found $list_id in $subscription
    * This Subscriber is already subscribed to this list
    *
    */
    $has_subscription = true;
  }

  return $has_subscription;
}

/*
*
* 6.2
* Get subscriber id from an email
* Accept the parameter $email with email value
*
*/
function mp_get_subscriber_id( $email ) {
  $subscriber_id = 0;
  /*
  * Check if subscriber already exist
  */
  $args = array(
    'post_type' =>  'mp_subscriber',
    'posts_per_page'  => 1,
    'meta_key'  =>  'mp_subscriber_email',
    'meta_value'  =>  $email
  );
  $subscriber_query = new WP_Query( $args );

  if( $subscriber_query->have_posts() ):
    $subscriber_query->the_post();
    $subscriber_id = get_the_ID();
  endif;
  wp_reset_query();

  return (int)$subscriber_id;
}

/*
*
* 6.3
* Get Subscriber subscription list
* Accept parameter $subscriber_id integer
*
*/
function mp_get_subscriptions( $subscriber_id ) {
  $subscriptions = [];

  // get subscriptions (return array of list objects)
  $lists = get_field( 'mp_subscriber_subscription', $subscriber_id );

  // If $lists returns something
  if( $lists ):

    if( is_array( $lists ) && count( $lists ) > 0 ):
      foreach( $lists as &$list ){
        /*
        * Store list id to $subscription[] array
        */
        $subscriptions[] = (int)$list->term_id;
      }
    elseif( is_numeric( $lists ) ):
      /*
      * Store current list store into $lists to $subscription[]
      */
      $subscriptions[] = $lists;
    endif;

  endif;
  /*
  * Return array of list_id
  */
  return $subscriptions;
}

/*
*
* 6.4
* TODO: this function is not useful yet
*
*/
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

/*
*
* 6.5
* Unsubscribe Subscriber to list
* Accept the parameter $subscriber_id and list_id = default null
*
*/
function mp_update_subscribe_subscription ( $subscriber_id, $list_id = null ) {

  $status = 0;
  if( mp_subscriber_has_subscription( $subscriber_id, $list_id ) ) {

    $subscription_list = mp_get_subscriptions( $subscriber_id );

    $needle = array_search( $list_id, $subscription_list );

    unset( $subscription_list[$needle] );

    /*
    * Update subscriber subscriptions
    */
    update_field( 'mp_subscriber_subscription', $subscription_list, $subscriber_id );
    $status = 1;
  }

  return $status;
}

/*
*
* 6.6
* Delete Data to subscriber
* Accept parameter $subscriber_id = default 0
*
*/
function mp_delete_subscriber_data( $subscriber_id = 0 ) {
  return wp_delete_post( $subscriber_id );
}



?>
