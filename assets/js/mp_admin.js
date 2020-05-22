jQuery( document ).ready( function($){
  /*
  if( $('body[class*=" mp_"]').length || $('body[class*=" post-type-mp_"]').length ) {
    $mp_menu_li = $('#toplevel_page_mp_dashboard_admin_page');

    $mp_menu_li.removeClass('wp-not-current-submenu').addClass('wp-has-current-submenu').addClass('wp-menu-open');
    $('a:first', $mp_menu_li).removeClass('wp-not-current-submenu').addClass('wp-has-current-submenu').addClass('wp-menu-open').addClass('wp-has-submenu');
  }
  /*
  if( $('body[class*=" mp_subscriber"]').length || $('body[class*=" post-type-mp_subscriber"]').length ) {
    $mp_menu_li = $('#toplevel_page_mp_subscriber_admin_page');

    $mp_menu_li.removeClass('wp-not-current-submenu').addClass('wp-has-current-submenu').addClass('wp-menu-open');
    $('a:first', $mp_menu_li).removeClass('wp-not-current-submenu').addClass('wp-has-current-submenu').addClass('wp-menu-open').addClass('wp-has-submenu');
  }
  */

} );


function copyText( event ) {

  /* Get the text field */
  var copyText = event.target;

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  alert("Copied the text: " + copyText.value);
}
