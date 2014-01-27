google.maps.visualRefresh = true;
var sv = new google.maps.StreetViewService();
var geocoder;
var map, streetLoc, score = 0, worstscore = 500, markersArray = [], latfrom = 50, latto = 60, lngfrom = -10, lngto = 1.6, guesscount, guesses = [], guess, miniMapMarkers = [];
var cities = [
    'birmingham',
    'london',
    'cardiff',
    'barry',
    'sully',
    'manchester',
    'blackpool',
    'leeds',
    'reading',
    'york',
    'bath',
    'lichfield',
    'norwich',
    'swaffham',
    'hull',
    'bridgend',
    'telford',
    'swaffham',
    'liverpool',
    'piccadilly circus',
    'carlisle',
    'cardiff bay',
    'cf11 0sn',
    'Buckingham Palace',
    'Sheffield',
    'bradford',
    'bristol',
    'Coventry',
    'wakefield',
    'Nottingham',
    'Newcastle upon Tyne',
    'Sunderland',
    'Brighton & Hove',
    'Kingston upon Hull',
    'Plymouth',
    'Wolverhampton',
    'Stoke-on-Trent',
    'Derby',
    'Southampton',
    'Salford',
    'City of Westminster',
    'Portsmouth',
    'Peterborough',
    'Chelmsford',
    'Oxford',
    'Canterbury',
    'St Albans',
    'Preston',
    'Lancaster',
    'cambridge',
    'exeter',
    'winchester',
    'worcester',
    'durham',
    'lincoln',
    'chester',
    'hereford',
    'sailsbury',
    'chichester',
    'ely',
    'truro',
    'ripton',
    'wells',
    'aberdeen',
    'dundee',
    'edinburgh',
    'glasgow',
    'inverness',
    'perth',
    'stirling',
    'bangor',
    'newport',
    'st asaph',
    'st david\'s',
    'swansea',
    'armagh',
    'belfast',
    'derry',
    'lisburn',
    'newry'
];
function initialize() {
    geocoder = new google.maps.Geocoder();

    var mapOptions = {
        center: new google.maps.LatLng(55, -4.5),
        zoom: 5,
        disableDefaultUI: true,
        mapTypeId: google.maps.MapTypeId.HYBRID
    };
    map = new google.maps.Map(
            document.getElementById('map-canvas'), mapOptions);

    google.maps.event.addListener(map, 'click', function(event) {
        $('#submit-btn').removeClass('disabled');
        clearOverlays();
        markersArray.push(new google.maps.Marker({
            position: event.latLng,
            map: map
        }));
        var dist = getDistanceFromLatLonInKm(streetLoc.lat(), streetLoc.lng(), event.latLng.lat(), event.latLng.lng());
        guess = {
            latLng: event.latLng,
            distance: dist,
            thisscore: Math.floor(Math.log(worstscore / dist) * 1000),
            actuallatLng: streetLoc
        };
    });

    codeAddress();

    $('#submit-btn').bind('mouseup', function(e) {
        if (guess != null && !$('#submit-btn').hasClass('disabled')) {
            miniMapMarkers = [];
            //add this submitted guess
            guesses.push(guess);
            markersArray.push(new google.maps.Marker({
                position: guess.actuallatLng,
                map: map
            }));
            //show this score
            showModal(guess);
            //topup current score
            score = score + guess.thisscore;
            $('#score').html(score);
            //now reset form
            $('#submit-btn').addClass('disabled');
            clearOverlays();
            map.setCenter(new google.maps.LatLng(55, -4.5));
            map.setZoom(5);
            //reset streetview
            codeAddress();
        }
    });
}

function clearOverlays() {
    for (var i = 0; i < markersArray.length; i++) {
        markersArray[i].setMap(null);
    }
    markersArray = [];
}

function processSVData(data, status) {
    if (status == google.maps.StreetViewStatus.OK) {
        streetLoc = data.location.latLng;

        var panoramaOptions = {
            position: streetLoc,
            addressControl: false,
            linksControl: false,
            pov: {
                heading: 34,
                pitch: 10
            }
        };
        var panorama = new google.maps.StreetViewPanorama(document.getElementById('pano'), panoramaOptions);
    } else {
        codeAddress();
    }
}


function codeAddress() {
    var address = cities[Math.floor(Math.random() * cities.length)] + ', UK';
    geocoder.geocode({'address': address}, function(results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
            streetLoc = results[0].geometry.location;
            sv.getPanoramaByLocation(streetLoc, 500, processSVData);
        } else {
            alert("Geocode was not successful for the following reason: " + status);
        }
    });
}

function randomBetween(from, to)
{
    return Math.random() * (to - from + 1) + from;
}

function getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
    var R = 6371; // Radius of the earth in km
    var dLat = deg2rad(lat2 - lat1);  // deg2rad below
    var dLon = deg2rad(lon2 - lon1);
    var a =
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2)
            ;
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var d = R * c; // Distance in km
    return d;
}

function deg2rad(deg) {
    return deg * (Math.PI / 180);
}

function showModal(guessobj) {
    $('#myModal').on('shown', function() {
        var mapOptions = {
            center: new google.maps.LatLng(55, -4.5),
            zoom: 5,
            disableDefaultUI: true,
            mapTypeId: google.maps.MapTypeId.HYBRID
        };
        var map = new google.maps.Map(
                document.getElementById('result-map'), mapOptions);

        var pinColor = "FE7569";
        var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
                new google.maps.Size(21, 34),
                new google.maps.Point(0, 0),
                new google.maps.Point(10, 34));
        var pinShadow = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",
                new google.maps.Size(40, 37),
                new google.maps.Point(0, 0),
                new google.maps.Point(12, 35));

        miniMapMarkers.push(new google.maps.Marker({
            position: guessobj.actuallatLng,
            map: map,
            icon: pinImage,
            shadow: pinShadow
        }));

        var pinColor = "BADA55";
        var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
                new google.maps.Size(21, 34),
                new google.maps.Point(0, 0),
                new google.maps.Point(10, 34));
        var pinShadow = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",
                new google.maps.Size(40, 37),
                new google.maps.Point(0, 0),
                new google.maps.Point(12, 35));

        miniMapMarkers.push(new google.maps.Marker({
            position: guessobj.latLng,
            map: map,
            icon: pinImage,
            shadow: pinShadow
        }));

        var LatLngList = [];
        var bounds = new google.maps.LatLngBounds();

        $.each(miniMapMarkers, function(i) {
            LatLngList.push(miniMapMarkers[i].getPosition());
            bounds.extend(LatLngList[i]);
        });

        var line = new google.maps.Polyline({
            path: [guessobj.latLng, guessobj.actuallatLng],
            strokeColor: "#FF0000",
            strokeOpacity: 1.0,
            strokeWeight: 2,
            map: map
        });

        miniMapMarkers = [];

        map.fitBounds(bounds);

        $('#myModalLabel').html('You were <strong>'+guessobj.distance.toFixed(2)+'Km</strong> away, for a score of <strong>'+guessobj.thisscore+' points!</strong>');
        $('#thisScore').html(guessobj.thisscore);
    });
    $('#myModal').modal('show');
}

google.maps.event.addDomListener(window, 'load', initialize);