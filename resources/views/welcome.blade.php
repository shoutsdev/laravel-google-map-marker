<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Google Map in Laravel - shouts.dev</title>

    <style type="text/css">
        #map {
            height: 400px;
        }
    </style>
</head>

<body>
<div class="container mt-5">
    <h2>Google Map in Laravel - shouts.dev</h2>
    <div id="map"></div>
</div>
@php
    $locations = [
                ['Khilkhet', 23.82973741600876, 90.42004192480192],
                ['Baridhar', 23.808117739943608, 90.44537670239676],
                ['300 Fit ', 23.836538363288035, 90.4658279948394],
                ['Tongi', 23.901545202737925, 90.40824277591372],
                ['Dhamrai', 23.914649046324804, 90.21735533044152],
                ['Manikganj', 23.86481597833292, 90.00501020845859],
            ];
@endphp
<script type="text/javascript">
    function initMap() {
        const myLatLng = { lat: 23.81663586829542, lng: 90.36618138671278 };
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 10,
            center: myLatLng,
        });

        var locations = {{ Js::from($locations) }};

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));

        }
    }

    window.initMap = initMap;
</script>

<script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap" ></script>

</body>
</html>
