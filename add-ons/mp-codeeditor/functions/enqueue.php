<?php
if( class_exists('MP_CodeEditor') ) {
  MP_CodeEditor::add('textarea_1');
}

$sass_output = array(
  array(
    'name'  =>  'mp-sass',
    'link'  =>  MP_CODEEDITOR_URL . 'assets/css/output.css',
    'type'  =>  'style',
    'after_script'  =>  array('mp-jquery'),
    'version' =>  '',
    'position'  =>  true,
  )
);
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


MP_Enqueue::addAdminEnqueue( $ce_sass );
MP_Enqueue::mergeAdminEnqueue( $ce_scripts );
MP_Enqueue::mergePublicEnqueue( $sass_output );


?>
