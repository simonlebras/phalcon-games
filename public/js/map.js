var map;
function initialize() {
    navigator.geolocation.getCurrentPosition(showPosition, errorPosition);
}

function showPosition(position){
    var mapOptions = {
        zoom: 8,
        center: new google.maps.LatLng(position.coords.latitude, position.coords.longitude)
    };
    map = new google.maps.Map(document.getElementById('map-canvas'),
        mapOptions);
    getUsersLocation();
}

function errorPosition(){
    var mapOptions = {
        zoom: 8,
        center: new google.maps.LatLng(0, 0)
    };
    map = new google.maps.Map(document.getElementById('map-canvas'),
        mapOptions);
    getUsersLocation();
}

function getUsersLocation(){
    $.ajax({
        type: 'GET',
        url: '/admin/userslocation'
    }).done(function (data) {
        users = JSON.parse(data)
        for (var user in users){
            addMarker(user);
        }
    }).fail(function () {
        alert("An error occured");
    });
}

function addMarker(user){
    var marker=new google.maps.Marker({
        position: new google.maps.LatLng(users[user].latitude, users[user].longitude),
        animation:google.maps.Animation.DROP
    });

    var infowindow = new google.maps.InfoWindow({
        content: user
    });

    marker.setMap(map);

    google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map,marker);
    });
}

google.maps.event.addDomListener(window, 'load', initialize);
