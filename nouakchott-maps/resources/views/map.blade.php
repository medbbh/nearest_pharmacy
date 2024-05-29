@extends('layouts.app')

@section('content')
<style>
    #map {
        height: 600px;
    }
</style>
<div id="map"></div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([your_default_latitude, your_default_longitude], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Add buildings layer from GeoServer
    L.tileLayer.wms("http://localhost:8080/geoserver/wms", {
        layers: 'ne:buildings',
        format: 'image/png',
        transparent: true,
        attribution: "Buildings"
    }).addTo(map);

    // Add roads layer from GeoServer
    L.tileLayer.wms("http://localhost:8080/geoserver/wms", {
        layers: 'ne:roads',
        format: 'image/png',
        transparent: true,
        attribution: "Roads"
    }).addTo(map);

    // Add natural elements layer from GeoServer
    L.tileLayer.wms("http://localhost:8080/geoserver/wms", {
        layers: 'ne:natural',
        format: 'image/png',
        transparent: true,
        attribution: "Natural Elements"
    }).addTo(map);

    // Add land use layer from GeoServer
    L.tileLayer.wms("http://localhost:8080/geoserver/wms", {
        layers: 'ne:landuse',
        format: 'image/png',
        transparent: true,
        attribution: "Land Use"
    }).addTo(map);
</script>
@endsection
