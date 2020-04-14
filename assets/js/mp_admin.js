jQuery( document ).ready( function($){

  if( $('body[class*=" mp_"]').length || $('body[class*=" post-type-mp_"]').length ) {
    $mp_menu_li = $('#toplevel_page_mp_dashboard_admin_page');

    $mp_menu_li.removeClass('wp-not-current-submenu').addClass('wp-has-current-submenu').addClass('wp-menu-open');
    $('a:first', $mp_menu_li).removeClass('wp-not-current-submenu').addClass('wp-has-current-submenu').addClass('wp-menu-open').addClass('wp-has-submenu');
  }

} );
