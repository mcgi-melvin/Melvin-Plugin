<?php
//5.1 Save Subscription Data to an existing or new subscriber
function mp_save_subscription() {

  // default result data
  $result = array(
    'status'  =>  0,
    'message' =>  'Subscription was not saved.',
  );

  try {
    // Get List ID
    $list_id = (int)$_POST['mp_subscription'];

    // Prepare subscriber data
    $subscriber_data = array(
      'fname' =>  esc_attr( $_POST['mp_fname'] ),
      'lname' =>  esc_attr( $_POST['mp_lname'] ),
      'email' =>  esc_attr( $_POST['mp_email'] ),
    );

    // Attempt to create/save subscriber
    $subscriber_id = mp_save_subscriber( $subscriber_data );

    // If subscriber was save successfully $subscriber_id will be greater than 0
    if( $subscriber_id ) :

      // Check if subscriber already has this subscription
      if( mp_subscriber_has_subscription( $subscriber_id, $list_id ) ) {

          $list = get_term( $list_id, 'subscriber_list' );
          $result['message'] .= esc_attr( $subscriber_data['email'] . ' is already subscribed to '. $list->name );

      } else {
          // Save new Subscription
          $subscription_saved = mp_add_subscription( $subscriber_id, $list_id );
          if( $subscription_saved ) {
            $result['status'] = 1;
            $result['message'] = 'Subscription Saved';
          }

      }

    endif;

  } catch( Exception $e ) {
    $result['message'] = 'Caught Exception: '. $e->getMessage();
  }

  echo json_encode($result);
  exit;
}

// 5.2 Create a new subscriber or update an existing one
function mp_save_subscriber( $subscriber_data ) {

  // Setup default subscriber id
  // 0 means the subscriber was not saved
  $subscriber_id = 0;

  try {

    $subscriber_id = mp_get_subscriber_id( $subscriber_data['email'] );
    if( $subscriber_id == 0 ):
      $subscriber_id = wp_insert_post(
        array(
          'post_type' =>  'mp_subscriber',
          'post_title'  =>  $subscriber_data['fname'] .' '. $subscriber_data['lname'],
          'post_status' =>  'publish',
        ),
        true
      );

      // Add/Update Custom Meta Data
      update_field( 'mp_fname', $subscriber_data['fname'], $subscriber_id );
      update_field( 'mp_lname', $subscriber_data['lname'], $subscriber_id );
      update_field( 'mp_email', $subscriber_data['email'], $subscriber_id );

    endif;

  } catch ( Exception $e ) {

  }

  wp_reset_query();
  return $subscriber_id;
}

// 5.3
// Adds List to subscribers subscriptions
function mp_add_subscription( $subscriber_id, $list_id ) {

  // default return value
  $subscription_saved = false;

  // Check if the subscriber does not have the current list subscription
  if( !mp_subscriber_has_subscription( $subscriber_id, $list_id ) ) {

    // Get Subscriptions and Append new $list_id
    $subscriptions = mp_get_subscriptions( $subscriber_id );
    array_push( $subscriptions, $list_id );

    // Update subscriber subscriptions
    update_field( 'mp_subscription', $subscriptions, $subscriber_id );

    $subscription_saved = true;
  }

  return $subscription_saved;

}


?>
