@extends('layouts.app')

@section('content')
<style>
    #map {
        height: 600px;
    }
    li {
        font-size: 20px;
        font-weight: 700;
        margin: 10px 0px 3px 5px;
    }
    li span {
        color: grey;
        font-size: 14px;
    }
</style>
<div id="map"></div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var userLat = {{ $lat }};
        var userLon = {{ $lon }};
        var map = L.map('map').setView([userLat, userLon], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        fetch('/get-building-data')
            .then(response => response.json())
            .then(data => {
                L.geoJSON(data, {
                    style: {
                        color: 'brown',
                        fillColor: 'tan',
                        fillOpacity: 0.5,
                        weight: 1
                    }
                }).addTo(map);
            });

        fetch('/get-road-data')
            .then(response => response.json())
            .then(data => {
                L.geoJSON(data, {
                    style: {
                        color: 'black',
                        weight: 2
                    }
                }).addTo(map);
            });

        fetch('/get-natural-data')
            .then(response => response.json())
            .then(data => {
                L.geoJSON(data, {
                    style: {
                        color: 'green',
                        fillColor: 'lightgreen',
                        fillOpacity: 0.5,
                        weight: 1
                    }
                }).addTo(map);
            });

        fetch('/get-landuse-data')
            .then(response => response.json())
            .then(data => {
                L.geoJSON(data, {
                    style: {
                        color: 'blue',
                        fillColor: 'lightblue',
                        fillOpacity: 0.5,
                        weight: 1
                    }
                }).addTo(map);
            });

        @foreach ($pharmacies as $pharmacy)
            L.marker([{{ $pharmacy->latitude }}, {{ $pharmacy->longitude }}]).addTo(map)
                .bindPopup('{{ $pharmacy->name }}');
        @endforeach
    });
</script>

<ul>
    @foreach ($pharmacies as $pharmacy)
        <li>{{ $pharmacy->name }} - <span>{{ $pharmacy->distance }} meters</span></li>
    @endforeach
</ul>
@endsection
