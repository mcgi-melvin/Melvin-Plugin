<?php
/*
acf_add_options_page(array(
  'page_title' 	=> 'MPP Code Editor',
  'menu_title'	=> 'MPP Code Editor',
  'menu_slug' 	=> 'mp-code-editor',
  'capability'	=> 'edit_posts',
  'redirect'		=> false,
  'icon_url'    =>  'dashicons-editor-code',
  'position'    =>  999
));*/
/**
 * Register a custom menu page.
 */
function wpp_codeeditor_register_menu_page() {
  add_menu_page( CE_ADDON_NAME, CE_ADDON_NAME, 'edit_posts', 'wpp-code-editor', 'callCodeEditor', 'dashicons-editor-code', 999 );
}


function callCodeEditor() {
  require MP_CODEEDITOR_PATH . 'functions/pages/wpp-editor.php';
}

?>
