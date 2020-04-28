<?php

Class MP_Enqueue {
  /*
  *
  *
  *
  *
  */
  private static $public_enqueue = array( );
  private static $private_enqueue = array( );
  private static $login_enqueue = array( );

  /*
  public function __construct() {
    add_action( self::$enqueue_in, array('MP_Enqueue', 'execute') );
  }
  */

  public static function addPublicEnqueue( $enqueue ) {
    array_push( self::$public_enqueue, $enqueue );
  }

  public static function addAdminEnqueue( $enqueue ) {
    array_push( self::$private_enqueue, $enqueue );
  }

  public static function addLoginEnqueue( $enqueue ) {
    array_push( self::$login_enqueue, $enqueue );
  }

  public static function mergePublicEnqueue( $enqueue ) {
    self::$public_enqueue = array_merge( (array)self::$public_enqueue, (array)$enqueue );
  }

  public static function mergeAdminEnqueue( $enqueue ) {
    self::$private_enqueue = array_merge( (array)self::$private_enqueue, (array)$enqueue );
  }

  public static function mergeLoginEnqueue( $enqueue ) {
    self::$login_enqueue = array_merge( (array)self::$login_enqueue, (array)$enqueue );
  }

  public static function executePublicEnqueue() {

    foreach( self::$public_enqueue as $enqueue ) :
      $user_status = true;
      if( isset( $enqueue['user_status'] ) ) {
        switch( $enqueue['user_status'] ) {
          case 'online':
            $user_status = is_user_logged_in() == true;
          break;
          case 'offline':
            $user_status = is_user_logged_in() == false;
          break;
          default:
            $user_status = $user_status;
          break;
        }
      }
      if( $user_status ):
        switch( $enqueue['type'] ) {
          case 'script':
            wp_register_script( $enqueue['name'], $enqueue['link'], $enqueue['after_script'], $enqueue['version'], $enqueue['position'] );
            if( isset( $enqueue['localize'] ) ) {
              self::localize( $enqueue['localize'], $enqueue['name'] );
            }
            wp_enqueue_script( $enqueue['name'] );
          break;
          case 'style':
            wp_register_style( $enqueue['name'], $enqueue['link'] );
            wp_enqueue_style( $enqueue['name'] );
          break;
        }
      endif;

    endforeach;

  }

  public static function executeAdminEnqueue() {

    foreach( self::$private_enqueue as $enqueue ) {

      switch( $enqueue['type'] ) {
       case 'script':
        wp_register_script( $enqueue['name'], $enqueue['link'], $enqueue['after_script'], $enqueue['version'], $enqueue['position'] );
        if( isset( $enqueue['localize'] ) ) {
          self::localize( $enqueue['localize'], $enqueue['name'] );
        }
        wp_enqueue_script( $enqueue['name'] );
       break;
       case 'style':
        wp_register_style( $enqueue['name'], $enqueue['link'] );
        wp_enqueue_style( $enqueue['name'] );
       break;
      }

    }

  }

  public static function executeLoginEnqueue() {

    foreach( self::$login_enqueue as $enqueue ) {

      switch( $enqueue['type'] ) {
       case 'script':
        wp_register_script( $enqueue['name'], $enqueue['link'], $enqueue['after_script'], $enqueue['version'], $enqueue['position'] );
        if( isset( $enqueue['localize'] ) ) {
          self::localize( $enqueue['localize'], $enqueue['name'] );
        }
        wp_enqueue_script( $enqueue['name'] );
       break;
       case 'style':
        wp_register_style( $enqueue['name'], $enqueue['link'] );
        wp_enqueue_style( $enqueue['name'] );
       break;
      }

    }

  }

  public static function localize( $localize, $name ) {
    wp_localize_script( $name, $localize['handle'], $localize['object_name']);
  }

}

?>
