var visitor_location = [];
jQuery( document ).ready( function($){
  getLocation();
} );

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(getGeoInfo);
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function getGeoInfo(position) {

    $.ajax({
        url: 'https://my-geo.tk',
        type: "GET",
        dataType: "json",
        success: function (data) {
          //eval("fetchSuccess(data)");
          var data_pos = {
            'action': 'mp_save_visitor_geo',
            'lat': position.coords.latitude,
            'long': position.coords.longitude,
            'time': position.timestamp,
            'ip_address': data.traits.ip_address,
            'country_code': data.country.iso_code,
            'country': data.country.names.en,
            'continent': data.continent.names.en,
          };
          mp_genericAjaxRequest(data_pos, 'POST', 'fetchSuccess');

        }
    });
}

function fetchSuccess(data) {
  console.log( data );
}
