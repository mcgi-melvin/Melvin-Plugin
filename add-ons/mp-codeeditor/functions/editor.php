<?php
use ScssPhp\ScssPhp\Compiler;
use ScssPhp\Server\Server;


// Ajax handler
//add_action( 'wp_ajax_nopriv_wpp_save_css_editor', 'wpp_save_css_editor' );
add_action( 'wp_ajax_wpp_save_css_editor', 'wpp_save_css_editor' );
function wpp_save_css_editor() {
  $directory = MP_CODEEDITOR_PATH . 'assets/css/';
  $response = [
  'status'  =>  0,
  'message' =>  "There's problem in your script"
  ];

  $code = $_POST['script'];
  $scss = new Compiler();

  $scss->setLineNumberStyle(Compiler::LINE_COMMENTS);
  $scss->setFormatter('ScssPhp\ScssPhp\Formatter\Compressed');

  $scss_file = fopen( $directory . 'output.scss', "w" );
  fwrite( $scss_file, $code );
  fclose($scss_file);

  //$script =  $scss->compile($code);
  //file_put_contents( $directory . 'output.css', $script );
  $scss->compile($code);
  $server = new Server($directory, null, $scss);
  $server->serve();

  $response['status'] = 1;
  $response['message']  = "Script Saved";
  echo json_encode( $server->serve() );
  exit();

}

add_action( 'wp_ajax_wpp_get_css_editor', 'wpp_get_css_editor' );
function wpp_get_css_editor() {
  $directory = MP_CODEEDITOR_PATH . 'assets/css/';
  $response = [
    'status'  =>  0,
    'script' =>  ""
  ];
  $scss = file_get_contents( $directory . 'output.scss' );
  $response['status'] = 1;
  $response['script'] = $scss;

  echo json_encode( $response );
  exit();
}

?>
