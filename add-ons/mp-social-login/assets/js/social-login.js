window.fbAsyncInit = function() {
  FB.init({
    //appId      : <?= get_option('mp_fb_app_id') ?>,
    appId      : social.fb_app_id,
    cookie     : true,                     // Enable cookies to allow the server to access the session.
    xfbml      : true,                     // Parse social plugins on this webpage.
    version    : 'v6.0'           // Use this Graph API version for this call.
  });

  /*
  FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
    statusChangeCallback(response);        // Returns the login status.
  });
  */

};

window.onbeforeunload = function(e){
  gapi.auth2.getAuthInstance().signOut();
};

jQuery(document).ready(function($){
  var meta = document.createElement('meta');
  meta.name = "google-signin-client_id";
  meta.content = social.google_api_key;
  document.getElementsByTagName('head')[0].appendChild(meta);
});

(function(d, s, id) {                      // Load the SDK asynchronously
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = social.fb_sdk_url;
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

(function(d, s, id) {                      // Load the SDK asynchronously
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = social.google_sdk_url;
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'google-jssdk'));

function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
  console.log('statusChangeCallback');     // The current login status of the person.
  console.log(response);     // The current login status of the person.
  if (response.status === 'connected') {   // Logged into your webpage and Facebook.
    mp_fb_save_user_information( response );
  }
}

function checkLoginState() {               // Called when a person is finished with the Login Button.
  /*
  FB.login(function(response) {
    statusChangeCallback(response);
  }, {
    scope:'id,name,email'
  });
  */

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
  
}

// Create Wordpress Account for User
function mp_fb_save_user_information( response ) {
  console.log('FB API');
  FB.api(
    '/me?fields=id,name,email',
    function( response ) {
      console.log(response);
      var data = {
        'action': 'mp_create_user_account',
        'referrer': 'facebook',
        'password': response.id,
        'name': response.name,
        'email': response.email,
      };
      mp_genericAjaxRequest( data, 'POST', 'loginCallback' );
    }
  );
}



function onGoogleSignIn( googleUser ) {
  var profile = googleUser.getBasicProfile();
  var data = {
    'action': 'mp_create_user_account',
    'referrer': 'google',
    'password': profile.getId(),
    'name': profile.getName(),
    'email': profile.getEmail(),
  };
  mp_genericAjaxRequest( data, 'POST', 'loginCallback' );
  /*
  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
  */
}

function loginCallback( response ) {
  console.log( response );
  if( response.loggin == 1 ) {
    //location.reload();
    window.location.replace( response.redirect_url );
  }
}
