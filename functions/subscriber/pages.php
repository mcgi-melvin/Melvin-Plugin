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
  ob_start();
  ?>
  <div class="wrap">
    <h2>Import Subscriber</h2>
  </div>
  <?php
  $output = ob_get_clean();
  echo $output;
}



?>
