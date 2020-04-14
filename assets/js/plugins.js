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
