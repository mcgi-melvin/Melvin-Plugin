jQuery( document ).ready( function($){

} );

function mp_genericAjaxRequest(data, method, callback){
  var call_back = (callback != "" || callback != null || callback != undefined) ? callback : '';
  $.ajax({
    method: method,
    url: mpAjax.ajaxurl,
    data: data,
    dataType: 'json',
    beforeSend: function(){

    },
    success: function(data){
      eval(call_back+"(data)");
    }
  });
}

function mp_message_popup( message ) {
  $('.mp-form-message').text( message );
  toggle_message();
  setTimeout( function(){
    toggle_message();
  }, 2000 );
}

function toggle_message() {
  $('.mp-form-message').toggleClass('mp-active');
}
