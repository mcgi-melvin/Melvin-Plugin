<?php
$visitors = array(
  'name' => 'WPP Visitor',
  'post_type' => 'mp_visitor',
  'taxonomies' => false,
  'icon'  =>  'dashicons-welcome-learn-more',
  'visibility'  =>  true
);
MP_PostType::add_post_type($visitors);

?>
