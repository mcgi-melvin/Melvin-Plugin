<?php

if( !class_exists('Easy_Include') ) {

  Class Easy_Include {

    private static $files = array();
    private static $folders = array();
    private static $allowed = array('php');

    public static function add_file( $path, $file ) {

      $target_file = $path . $file;

      array_push( self::$files, $target_file);
    }

    public static function add_folder( $folder_path ) {
      array_push( self::$folders, $folder_path );
    }

    public static function initiate_folders() {
      foreach( self::$folders as $folder ):
        $files = array_diff( scandir( $folder, 1 ), array('..', '.') );
        foreach( $files as $file ) {

          $type = pathinfo($file, PATHINFO_EXTENSION);
          if( !in_array( $type, self::$allowed ) ) {
            continue;
          }

          if( file_exists( $folder . $file ) ) {
            include_once( $folder . $file );
          }
        }
      endforeach;
    }

    public static function initiate_files() {
      foreach( self::$files as $file ):
        if( file_exists( $file ) ):
          include $file;
        endif;
      endforeach;
    }

    public static function execute() {
      self::initiate_files();
      self::initiate_folders();
    }

  }



}


?>
