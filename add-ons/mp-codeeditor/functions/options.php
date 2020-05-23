<?php
/**
 * Register a custom menu page.
 */

if( !class_exists('WPP_Editor_Page') ) :
class WPP_Editor_Page {
    protected $views = array();
    protected $parent_slug = 'wpp-code-editor';

    function __construct() {
      add_action( 'admin_menu', array($this, 'wpp_editor_create_menus') );
    }

    function load_view() {
        // current_filter() also returns the current action
        $current_page = $this->views[current_filter()];
        include( MP_CODEEDITOR_PATH.'functions/pages/'.$current_page.'.php' );
    }

    function wpp_editor_create_menus() {
        $view_hook_name = add_menu_page(
          CE_ADDON_NAME,
          CE_ADDON_NAME,
          'manage_options',
          $this->parent_slug,
          array(&$this, 'load_view'),
        );
        $this->views[$view_hook_name] = $this->parent_slug;
        $view_hook_name = add_submenu_page(
          $this->parent_slug,
          'SASS/CSS Code Editor',
          'SASS/CSS Code Editor',
          'edit_posts',
          'wpp-css-code-editor',
          array(&$this, 'load_view')
        );
        $this->views[$view_hook_name] = 'wpp-css-editor';
        $view_hook_name = add_submenu_page(
          $this->parent_slug,
          'Javascript Code Editor',
          'Javascript Code Editor',
          'edit_posts',
          'wpp-js-code-editor',
          array(&$this, 'load_view')
        );
        $this->views[$view_hook_name] = 'wpp-js-editor';
    }
}
endif;

$menu = new WPP_Editor_Page();
?>
