<?php

Class Message {

  /*
  *
  * Handle Response Status
  * 0 - For negative/error response
  * 1 - For Success response
  *
  */
  private static $status = 0;


  /*
  * Handle the messages
  *
  *
  */
  private static $message;


  /*
  *
  * Handle Message Type
  * Default - Display Normal Message
  * Modal/Popup - Displaying Popup
  *
  */
  private static $type = [ 'default', 'popup' ];


  /*
  *
  *
  *
  */
  public static function __construct( $text ) {
    self::set_status( $text['status'] );
    self::display_message();
  }

  public static function set_status( $status ) {
    self::$status = $status;
  }

  public static function format_default() {
    $format = "";

    return $format;
  }

  public static function format_popup() {
    $format = "";

    return $format;
  }

  public static function display_message() {

    $output = "";

    if( self::$status == 0 ) {
      return false;
    }


    return $output;

  }

}

?>
