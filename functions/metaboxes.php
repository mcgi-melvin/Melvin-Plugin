<?php

//add_action('add_meta_boxes_{post-type}','');
//add_action('add_meta_boxes_mp_subscriber','mp_add_subscriber_metaboxes');
function mp_add_subscriber_metaboxes( $post ) {
  add_meta_box(
    'mp_subscriber_details',
    'Subscriber Details',
    'mp_subscriber_metabox', // Callback Function
    'mp_subscriber',
    'normal',
    'default'
  );
}



?>
