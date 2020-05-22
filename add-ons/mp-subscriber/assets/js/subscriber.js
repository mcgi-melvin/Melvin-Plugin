jQuery( document ).ready( function($){

  $( '#mp_form' ).bind( 'submit', function(e){
    e.preventDefault();
    $form = $(this);
    var form_data = $form.serialize();
    $('.button-loader').show();
    mp_genericAjaxRequest(form_data, 'POST', 'formCallback');
  } );

  mp_get_subscription_list();

} );

function formCallback( response ) {
  console.log( response );
  $('.button-loader').hide();
  mp_message_popup( response.message );
}

function mp_get_subscription_list (){
  var data = {
    'action'  : 'mp_get_subscription_list',
    'subscriber_id' : $('#mp_manage_subscription_form_container').attr('data-subscriber')
  };

  mp_genericAjaxRequest( data, 'POST', 'populate_subscription_list' );
}

function populate_subscription_list( response ) {
  $('.mp_tbody_subscriber_list').empty();
  //<input type="checkbox" name="list_id[]" value='${ JSON.stringify( data ) }' />
  for( var i = 0; i < response.length; i++ ) {
    var data = response[i];
    $('.mp_tbody_subscriber_list').append(`
      <tr class="mp-text-center">
        <td>
          <h4>${ data.name }</h4>
          <p>${ data.description }</p>
        </td>
        <td>
          <input type="checkbox" name="list_id[]" value='${ data.term_id }' />
        </td>
      </tr>
      `);
  }

}

function mp_unsubscribe_list( e ) {
  e.preventDefault();
  var lists = [];
  var data = {
    'action'  : 'mp_unsubscribe_subscription',
    'subscriber_id' : $('#mp_manage_subscription_form_container').attr('data-subscriber'),
    'list_id' : lists
  };

  $('.mp_tbody_subscriber_list input:checked').each(function(){
     lists.push( $(this).val() );
  });

  mp_genericAjaxRequest( data, 'POST', 'unsubscribe_callback' );
}

function unsubscribe_callback( response ) {
  location.reload();
  mp_get_subscription_list();
}

function mp_subscriber_deleteRecord() {
  var data = {
    'action'  : 'mp_unsubscribe',
    'subscriber_id' : $('#mp_manage_subscription_form_container').attr('data-subscriber')
  };

  mp_genericAjaxRequest( data, 'POST', 'deleteRecordCallback' );
}

function deleteRecordCallback( response ) {
  if( response.status == 1 ) {
    window.location.href = window.location.href + '/mp_subscriber_unsubscribe=' + response.status;
  }
  console.log( response );

}
