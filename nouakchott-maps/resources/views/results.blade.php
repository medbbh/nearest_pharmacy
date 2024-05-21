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
</style>
<div id="map" style="height: 600px;"></div>
<script>
    var map = L.map('map').setView([18.0735, -15.9582], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    @foreach ($pharmacies as $pharmacy)
        L.marker([{{ $pharmacy->latitude }}, {{ $pharmacy->longitude }}]).addTo(map)
            .bindPopup('{{ $pharmacy->name }}');
    @endforeach
</script>

<ul>
    @foreach ($pharmacies as $pharmacy)
        <li>{{ $pharmacy->name }} - <span>{{ $pharmacy->distance }} meters<span></li>
    @endforeach
</ul>
@endsection