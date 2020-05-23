<?php
if( class_exists('MP_CodeEditor') ) {
  MP_CodeEditor::add('textarea_1');
}

$sass_output = array();
$ce_sass = array(
  'name'  =>  'mp-sass',
  'link'  =>  MP_CODEEDITOR_URL . 'assets/js/sass.js',
  'type'  =>  'script',
  'after_script'  =>  array('mp-jquery'),
  'version' =>  '',
  'position'  =>  true,
);
$ce_scripts = array(
  array(
    'name'  =>  'mp-codemirror',
    'link'  =>  MP_CODEEDITOR_URL . 'assets/js/codemirror.js',
    'type'  =>  'script',
    'after_script'  =>  array('mp-jquery'),
    'version' =>  '',
    'position'  =>  true,
  ),
  array(
    'name'  =>  'mp-code-editor',
    'link'  =>  MP_CODEEDITOR_URL . 'assets/js/codeeditor.js',
    'type'  =>  'script',
    'after_script'  =>  array('mp-jquery'),
    'version' =>  '',
    'position'  =>  true,
    'localize'  =>  array(
      'handle'  =>  'code_elem',
      'object_name' => class_exists('MP_CodeEditor') ?? MP_CodeEditor::create()
    )
  ),
  array(
    'name'  =>  'mp-codemirror',
    'link'  =>  MP_CODEEDITOR_URL . 'assets/css/codemirror.css',
    'type'  =>  'style',
  )
);


$files = array_diff( scandir( MP_CSS_FOLDER_OUTPUT, 1 ), array('..', '.') );
foreach( $files as $i => $file ) {
  $allowed = ['css'];
  $type = pathinfo($file, PATHINFO_EXTENSION);
  if( !in_array( $type, $allowed ) ) {
    continue;
  }

  if( file_exists( MP_CSS_FOLDER_OUTPUT . $file ) ) {

    array_push( $sass_output, array(
      'name'  =>  'mp-sass-output-'.$i,
      'link'  =>  MP_CSS_FOLDER_OUTPUT_URI . $file,
      'type'  =>  'style',
      'version' =>  '',
    ) );
  }
}

MP_Enqueue::addAdminEnqueue( $ce_sass );
MP_Enqueue::mergeAdminEnqueue( $ce_scripts );
MP_Enqueue::mergePublicEnqueue( $sass_output );


?>
