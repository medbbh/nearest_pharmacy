@extends('layouts.app')

@section('content')
<style>
    body {
    justify-content: center;
    align-items: center;
    background: #F9F6EE;
    min-height: 100vh;
    }
    button{
        background-color:blue;
        font-size:20px;
        width:30%;
        border-radius:7px;
        color:white;
        font-weight:700;
        padding:10px;
        border:none;
        margin-top:20px;
        cursor:pointer;
    }
    form{
        display:flex;
        justify-content: center;
        align-items: center;
    }
</style>
<div id="map" style="height: 600px"></div>

<form id="location-form" action="/find" method="post">
    @csrf
    <input type="hidden" name="latitude" id="latitude" placeholder="Latitude">
    <input type="hidden" name="longitude" id="longitude" placeholder="Longitude">
    <button type="submit">Trouver les plus proches pharmacies</button>
</form>


<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([0, 0], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    if (navigator.geolocation) {    
        navigator.geolocation.getCurrentPosition(function(position) {
            var userLatitude = position.coords.latitude;
            var userLongitude = position.coords.longitude;

            // Set user's location as map center
            map.setView([userLatitude, userLongitude], 13);

            // Add marker for user's location
            var userLocation = L.marker([userLatitude, userLongitude]).addTo(map);
            userLocation.bindPopup('Your Location');

            // Populate latitude and longitude fields in the form
            document.getElementById('latitude').value = userLatitude;
            document.getElementById('longitude').value = userLongitude;
        });
    } else {
        console.error('Geolocation is not supported by this browser.');
    }
</script>
@endsection
