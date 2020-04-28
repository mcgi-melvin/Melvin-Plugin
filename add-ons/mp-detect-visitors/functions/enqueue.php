<?php

$location = array(
    'name'  =>  'mp-location-js',
    'link'  =>  MP_VISITOR_URL . 'assets/js/location.js',
    'type'  =>  'script',
    'after_script'  =>  array('mp-main'),
    'version' =>  '',
    'position'  =>  true,
);
MP_Enqueue::addPublicEnqueue( $location );

?>
