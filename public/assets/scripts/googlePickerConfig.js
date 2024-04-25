// Get element references
var confirmBtn = document.getElementById('confirmPosition');
var findLocationBtn = document.getElementById('findLocation');
var onClickPositionView = document.getElementById('onClickPositionView');
var onIdlePositionView = document.getElementById('onIdlePositionView');

var defaultLocation = { lat: 6.93258859118141, lng: 79.8438596551898 };
var lp = new locationPicker('map', {
    setCurrentPosition: false,
    lat: defaultLocation.lat,
    lng: defaultLocation.lng
}, {
    zoom: 15
});

confirmBtn.onclick = function () {

    var location = lp.getMarkerPosition();
    onClickPositionView.innerHTML = 'The chosen location is ' + location.lat + ',' + location.lng;
};

google.maps.event.addListener(lp.map, 'idle', function (event) {
    var location = lp.getMarkerPosition();
    onIdlePositionView.innerHTML = 'The chosen location is ' + location.lat + ',' + location.lng;
});

findLocationBtn.onclick = function() {

    navigator.geolocation.getCurrentPosition(function(position) {
        var currentLocation = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
        };

        lp.map.setCenter(currentLocation);
        lp.map.setZoom(15);
        lp.setLocation(currentLocation);
    }, function() {
        alert('Error: The Geolocation service failed.');
    });
};
