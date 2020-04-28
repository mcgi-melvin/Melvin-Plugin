jQuery( document ).ready( function($){

  $( '#melvin_plugin_form' ).bind( 'submit', function(e){
    e.preventDefault();
    $form = $(this);
    var form_data = $form.serialize();
    mp_genericAjaxRequest(form_data, 'POST', 'formCallback');
  } );

} );

function formCallback( response ) {
  $('.mp-form-message').text( response.message );
}
