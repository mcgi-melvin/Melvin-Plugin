<?php
/*
*
* 5.1
* Save Subscription Data to an existing or new subscriber
* Function called by ajax in subscriber.js
* Passing the request type $_POST
*
*/
function mp_save_subscription() {

  // default result data
  $result = array(
    'status'  =>  0,
    'message' =>  'Subscription Failed. ',
  );

  try {
    // Get List ID
    $list_id = (int)$_POST['mp_subscriber_subscription'];

    // Remove action key in $_POST
    unset( $_POST['action'] );

    // Attempt to create/save subscriber
    $subscriber_id = (int)mp_save_subscriber( $_POST );

    // If subscriber was save successfully $subscriber_id will be greater than 0
    if( $subscriber_id ) :

      // Check if subscriber already has this subscription
      if( mp_subscriber_has_subscription( $subscriber_id, $list_id ) ) {

          $list = get_term( $list_id, 'subscriber_list' );
          if( $list ) {
            $result['message'] .= esc_attr( $_POST['mp_subscriber_email'] . ' is already subscribed to '. $list->name );
          }

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

/*
*
* 5.3
* Adds List to subscribers subscriptions
* Accepts parameter $subscriber_id integer, $list_id integer
*
*/
function mp_add_subscription( $subscriber_id, $list_id ) {

  // default return value
  $subscription_saved = false;

  // Check if the subscriber does not have the current list subscription
  if( !mp_subscriber_has_subscription( $subscriber_id, $list_id ) ) {

    // Get Subscriptions and Append new $list_id
    $subscriptions = mp_get_subscriptions( $subscriber_id );
    array_push( $subscriptions, $list_id );

    // Update subscriber subscriptions
    update_field( 'mp_subscriber_subscription', $subscriptions, $subscriber_id );

    $subscription_saved = true;
  }

  return $subscription_saved;
}


/*
*
* 5.4
* Process of unsubscribing subscriber
* Called by ajax function mp_unsubscribe_list() in subscriber.js
* Accepting request method $_POST
* Accepting parameters $_POST['subscriber_id'] integer, $_POST['list_id'] array of list from the form
*
*/
function mp_unsubscribe_subscription() {

  $subscriber_id = isset( $_POST['subscriber_id'] ) && is_numeric( $_POST['subscriber_id'] ) ? (int)$_POST['subscriber_id'] : (int)Cryptor::decrypt( $_POST['subscriber_id'] );
  $list_ids = isset( $_POST['list_id'] ) ? (array)$_POST['list_id'] : [];

  foreach( $list_ids as $list_id ) {
    mp_update_subscribe_subscription( $subscriber_id, $list_id );
  }

}

/*
*
* 5.5
* Geting subscription list of subscriber
* Called by ajax function mp_get_subscription_list() in subscriber.js
* Accepting method $_POST
* Accepting parameter $_POST['subscriber_id'] integer or Encrypted
*
*/
function mp_get_subscription_list() {

  $subscriber_id = 0;
  $subscriber_list = [];

  if( isset( $_POST['subscriber_id'] ) ) {
    /*
    * Decrypt $_POST['subscriber_id'] if is not numeric
    * store in $subscriber_id otherwise.
    */
    if( !is_numeric( $_POST['subscriber_id'] ) ) {
      $subscriber_id = (int)Cryptor::decrypt( $_POST['subscriber_id'] );
    } else {
      $subscriber_id = (int)$_POST['subscriber_id'];
    }
  }

  $list = mp_get_subscriptions( $subscriber_id );

  /*
  *
  * if $list has value, get terms from $list_id integer
  * data stored in $subscriber_list
  *
  */
  if( $list ) {
    $subscriber_list = get_terms(
      array(
        'taxonomy'  =>  'subscriber_list',
        'include' =>  $list
      )
    );
  }

  echo json_encode( $subscriber_list );
  exit();
}

/*
*
* 5.6
* Processing unsubscription
* Called by ajax function mp_unsubscribe_list() in subscriber.js
* Accepting method request of $_POST
* Accepting parameter $subscriber_id integer or encrypted
*
*/
function mp_unsubscribe() {
  $response = array(
    'status'  =>  0,
    'message' =>  'Something went wrong'
  );
  $subscriber_id = isset( $_POST['subscriber_id'] ) ? (int)Cryptor::decrypt( $_POST['subscriber_id'] ) : 0;

  if( FALSE !== get_post_status( $subscriber_id ) ) {
    $delete = mp_delete_subscriber_data( $subscriber_id );

    if( $delete !== false ) {
      $response['status'] = 1;
      $response['message'] = 'Unsubscribe successful';
    }
  }

  echo json_encode( $response );
  exit();
}
























?>
