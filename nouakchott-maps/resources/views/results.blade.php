@extends('layouts.app')

@section('content')
<style>
    li{
        font-size:20px;
        font-weight:700;
        margin: 10px 0px 3px 5px
    }
    li span{
        color:grey;
        font-size:14px
    }
    button{
        background-color:blue;
        color:white;
        font-weight:700;
        padding:5px;
        border:none;
        margin-left:10px;
    }
</style>
<div id="map" style="height: 600px;"></div>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
<script>
    var map = L.map('map').setView([{{ $lat }}, {{ $lon }}], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    var userLocation = L.marker([{{ $lat }}, {{ $lon }}]).addTo(map);
    userLocation.bindPopup('Your Location').openPopup();

    var routingControl = null;

    @foreach ($pharmacies as $pharmacy)
        var pharmacyMarker = L.marker([{{ $pharmacy->latitude }}, {{ $pharmacy->longitude }}]).addTo(map)
            .bindPopup('{{ $pharmacy->name }}');

        pharmacyMarker.on('click', function() {
            if (routingControl !== null) {
                map.removeControl(routingControl);
            }
            routingControl = L.Routing.control({
                waypoints: [
                    L.latLng({{ $lat }}, {{ $lon }}),
                    L.latLng({{ $pharmacy->latitude }}, {{ $pharmacy->longitude }})
                ]
            }).addTo(map);
        });
    @endforeach
</script>

<ul>
    @foreach ($pharmacies as $pharmacy)
        <li>
            {{ $pharmacy->name }} - <span>{{ $pharmacy->distance }} meters</span>
            <button onclick="showRoute({{ $pharmacy->latitude }}, {{ $pharmacy->longitude }})">Show Route</button>
        </li>
    @endforeach
</ul>

<script>
    function showRoute(pharmacyLat, pharmacyLon) {
        if (routingControl !== null) {
            map.removeControl(routingControl);
        }
        routingControl = L.Routing.control({
            waypoints: [
                L.latLng({{ $lat }}, {{ $lon }}),
                L.latLng(pharmacyLat, pharmacyLon)
            ]
        }).addTo(map);
    }
</script>
@endsection
