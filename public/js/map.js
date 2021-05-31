var myMap,
    markers = [];

function initMap() {
    var element = document.getElementById("map");
    var table = element.dataset.table;
    // coordinate center
    let lat = 50.46687;
    let lng = 30.52582;

    $(element).css({'height': '600px'});

    var options = {
        center: {
            lat: lat,
            lng: lng
        },
        zoom: 6
    };
    myMap = new google.maps.Map(element, options);

    dataObject.data.forEach(function(item, i) {
        var properties = {};
        console.log(item);

        if(table == 'cargo') {
            properties = {
                lat: +item.loc_lat_from,
                lng: +item.loc_lng_from
            };
        } else if(table == 'car') {
            properties = {
                lat: +item.loc_lat,
                lng: +item.loc_lng
            };
        }
        ajaxCardContent(item.id, table, properties);
    });
}

function ajaxCardContent(id, table, properties) {
    $.ajax({
        type: 'GET',
        url: '/' + table + '/ajax/map_' + table,
        data: {
            'id': id
        },
        dataType: 'json',
        success: function(res) {
            properties.content = res.view;
            addMarker(properties);
        },
        error: function() {
            console.log('Что-то пошло не так!');
        }
    });
}

function addMarker(properties) {

    let positionLatLng = new google.maps.LatLng(properties.lat, properties.lng);
    //console.log('Еще проверка ' + positionLatLng);
    var positionFinal = positionLatLng;

    if(markers.length != 0) {
        for(i=0; i < markers.length; i++) {
            let currentMarker = markers[i];
            let posMarker = currentMarker.getPosition();

            if(positionLatLng.equals(posMarker)) {
                var newLat = positionLatLng.lat() + (Math.random() -.5) / 100;
                var newLng = positionLatLng.lng() + (Math.random() -.5) / 100;
                positionFinal = new google.maps.LatLng(newLat,newLng);
            }
        }
    }

    var marker = new google.maps.Marker({
        position: positionFinal,
        map: myMap,
        //animation: google.maps.Animation.DROP,
    });

    markers.push(marker);

    if(properties.content) {
        let infoWindow = new google.maps.InfoWindow({
            content: properties.content
        });
        marker.addListener('click', function() {
            infoWindow.open(myMap, marker);

            // if (marker.getAnimation() !== null) {
            //     marker.setAnimation(null);
            // } else {
            //     marker.setAnimation(google.maps.Animation.BOUNCE);
            // }
        });
    }
}
