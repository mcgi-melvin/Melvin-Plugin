<?php

add_action( 'login_form', 'mp_social_wp_login' );
function mp_social_wp_login(){
    //Output your HTML
    echo do_shortcode('[wpp-social-login]');
}

function mp_create_user_account() {

  $response = array(
    'status' => 0,
    'loggin'  =>  0,
    'message' => 'Something went wrong!',
    'redirect_url'  =>  admin_url()
  );

  $name = sanitize_text_field( preg_replace('/\s+/', '_', strtolower( $_POST['name'] ) ) );
  switch( $_POST['referrer'] ) {
    case 'facebook':
      $username = sanitize_user( 'fb_' . $name . '_' . uniqid() );
    break;
    case 'google':
      $username = sanitize_user( 'google_' . $name . '_' . uniqid() );
    break;
    default:
      $username = null;
    break;
  }

  $email = sanitize_email( $_POST['email'] );
  $password = (int)$_POST['password'];

  if( email_exists( $email ) ) {
    mp_login_user_account( $email );
  }

  if( username_exists( $username ) && $username != null ) {
    $response['message'] = "Username Already Exist!";
    echo json_encode( $response );
    exit;
  }

  $user_id = wp_create_user( $username, $password, $email );
  $user = new WP_User($user_id);
  $user->set_role('subscriber');
  $response = array(
   'status' => 1,
   'message' => 'Account Created Successfully'
  );
  echo json_encode( $response );
  mp_login_user_account( $user->user_email );

}

function mp_login_user_account( $email ) {

    $response = array(
      'status' => 1,
      'loggin'  =>  1,
      'message' => 'You have login successfully',
      'redirect_url'  =>  admin_url()
    );
    $user = get_user_by('email', $email );

    wp_clear_auth_cookie();
    wp_set_current_user( $user->ID );
    wp_set_auth_cookie( $user->ID );

    if( isset( $_GET['redirect_to'] ) ) {
      wp_redirect( $_GET['redirect_to'] );
    }

    echo json_encode( $response );
    exit;

}



?>
