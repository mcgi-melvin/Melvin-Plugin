<?php


function mp_social_shortcode( $atts, $content="" ) {

  ob_start();
  if( !get_option('mp_fb_app_id') ) {
    return false;
  }
  ?>
  <style>
  .mp-social-login-button {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  .mp-social-login-button > div {
    margin-bottom: 10px;
  }
  </style>
  <div class="mp-social-login-button">

    <div class="fb-login-button" data-size="large" data-button-type="login_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false" data-width="" data-scope="email" onlogin="checkLoginState()" ></div>

    <!--
      <fb:login-button size="medium" onlogin="checkLoginState()">
        Connect with Facebook
      </fb:login-button>
    -->
    <div class="g-signin2" data-onsuccess="onGoogleSignIn"></div>
  </div>
  <?php
  $output = ob_get_clean();
  return $output;
}

?>
