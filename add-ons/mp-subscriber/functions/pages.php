<?php

function mp_dashboard_admin_page() {
  $ouput = '';
  ob_start();
  ?>
  <div class="wrap">
    <h2>Melvin Special Plugin</h2>
    <p>Testing</p>
  </div>
  <?php
  $output = ob_get_clean();
  echo $output;
}

function mp_import_admin_page() {
  ob_start();
  ?>
  <div class="wrap">
    <h2>Import Subscribers</h2>
  </div>
  <?php
  $output = ob_get_clean();
  echo $output;
}

function mp_option_admin_page() {

  $options = mp_get_current_options();

  ob_start();
  //require PLUGIN_PATH . 'includes/pages/page.options.php';
  $output = ob_get_clean();
  echo $output;
}



?>
