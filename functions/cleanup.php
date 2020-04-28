<?php

function removeNotices() {

  $allowed = array('mp_dashboard_admin_page','mp_option_admin_page','mp_subscriber','mp_visitor');
  if( isset( $_GET['page'] ) && !in_array( $_GET['page'], $allowed ) ) {
    return;
  }

  if( isset( $_GET['post_type'] ) && !in_array( $_GET['post_type'], $allowed ) ) {
    return;
  }


  remove_all_actions('admin_notices');
  remove_all_actions('all_admin_notices');

  /*
  add_action('admin_notices', function () {
    echo 'My notice';
  });
  */

}

?>
