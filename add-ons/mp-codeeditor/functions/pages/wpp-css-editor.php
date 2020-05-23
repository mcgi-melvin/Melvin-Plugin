
<div class="wpp-editor-container wpp-container">
  <div class="wpp-title">
    <h2><?= CE_ADDON_NAME ?></h2>
  </div>
  <div class="wpp-editor-section-title">
    <h4>SASS/CSS Script</h4>
  </div>
  <form id="form-codeeditor-css">
    <textarea id="textarea-codeeditor-css" class="wpp-codeeditor" data-code="sass">
    </textarea>
    <div class="wpp-text-right">
      <div class="wpp-codeeditor-message">
      </div>
      <img src="<?= PLUGIN_URL . 'assets/images/loader.svg' ?>">
      <input type="submit" class="wpp-button wpp-ml-auto" value="Save" />
    </div>
  </form>
</div>
<script>
var css_editor;
jQuery(document).ready(function(){
  var data = {
    action: 'wpp_get_css_editor'
  };
  var textarea = document.getElementById('textarea-codeeditor-css');
  var type = textarea.getAttribute('data-code');
  css_editor = CodeMirror.fromTextArea(textarea, {
    lineNumbers: true,
    mode: type,
    theme: 'colorforth',
    matchBrackets: true,
    indentUnit: 0,
    smartIndent: false,
  });

  mp_genericAjaxRequest( data, 'GET', 'populate_textarea' );

  $(window).keydown(function(event) {
    /*
    Save Script with CTRL+S
    */
    if (event.keyCode == 83 && event.ctrlKey) {
      event.preventDefault();
      submit_form();
      return false;
    }
  });

  $('#form-codeeditor-css').on('submit', function(e){
    e.preventDefault();
    submit_form();
  });
});

function submit_form() {
  var code = css_editor.getValue();
  var data = {
    action  : 'wpp_save_css_editor',
    script  : code
  };
  mp_genericAjaxRequest(data, 'POST', 'response_css_editor');
}

function response_css_editor( response ) {
  console.log( response );
  $('.wpp-codeeditor-message').text('');
  if( response.message == "" || response.message == null ) {
    $('.wpp-codeeditor-message').text( 'Saved' );
  } else {
    $('.wpp-codeeditor-message').text( response.message );
  }

}

function populate_textarea( response ) {
  if( response.status == 0 ) {
    return false;
  }
  var script = response.script;
  css_editor.setValue( script );
}
</script>
