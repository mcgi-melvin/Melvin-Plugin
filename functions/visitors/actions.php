<?php

function save_visitor_geo() {
  $data = [];
  $data['ip_address'] = $_POST['ip_address'];
  $data['lat'] = $_POST['lat'];
  $data['lng'] = $_POST['long'];
  $data['country_code'] = $_POST['country_code'];
  $data['country'] = $_POST['country'];
  $data['continent'] = $_POST['continent'];
  $data['timestamp'] = (int)$_POST['timestamp'];
  $visitor = new MP_Visitor( $data );

  echo $visitor->checkVisitorStatus();
  exit;
}

?>
