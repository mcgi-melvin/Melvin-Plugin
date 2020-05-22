<?php

$enqueue = array(
  array(
    'name'  =>  'mp-subscriber',
    'link'  =>  MP_SUBSCRIBER_URL . 'assets/js/subscriber.js',
    'type'  =>  'script',
    'after_script'  =>  array('mp-jquery'),
    'version' =>  '',
    'position'  =>  true,
  )
);
MP_Enqueue::mergePublicEnqueue( $enqueue );

?>
