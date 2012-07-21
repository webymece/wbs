window.addEventListener('load',function(){
    var add = document.getElementById("m_address").value;
    var place = document.getElementById("m_place").value;
    
    getLatLng(add, place);
});


function getLatLng(add, place){
    var geocoder = new google.maps.Geocoder();

    geocoder.geocode({address:add },function(results,status){
        var latlng = results[0].geometry.location;
        var lng = latlng.lng();
        var lat = latlng.lat();

        console.log(lat+" : "+lng);
        displayMap(add, place, lat, lng);
    });
}

function displayMap(address, place, lat, lng) {
    var myOptions = {
        scaleControl: false,
        center: new google.maps.LatLng(lat, lng),
        zoom: 14,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById('map'), myOptions);

    var marker = new google.maps.Marker({
        map: map,
        position: map.getCenter()
    });
    var infowindow = new google.maps.InfoWindow();
}
