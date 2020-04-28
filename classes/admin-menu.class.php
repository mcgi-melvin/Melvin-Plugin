<?php

Class MP_Admin_Menu {

  private static $parent = array();
  private static $child = array();

  public static function add_menu( $option ) {
    array_push( self::$parent, $option );
  }

  public static function add_sub_menu( $option ) {
    array_push( self::$child, $option );
  }

  public static function get_parents() {
    return self::$parent;
  }

  public static function get_children() {
    return self::$child;
  }
  /*
  * Execute Menus and Submenus
  *
  *
  */
  public static function execute() {
    if( self::get_parents() ):
      foreach( self::get_parents() as $parent ):
        acf_add_options_page( $parent );

        if( self::get_children() ) {
          foreach( self::get_children() as $child ) {
            if( !isset( $parent['menu_slug'] ) AND !empty( $parent['menu_slug'] ) ) {
              continue;
            }

            if( !isset( $child['parent_slug'] ) AND !empty( $child['parent_slug'] ) ) {
              continue;
            }

            if( $parent['menu_slug'] !== $child['parent_slug'] ) {
              continue;
            }
            acf_add_options_sub_page( $child );
          }
        }

      endforeach;
    endif;
  }

}

?>
