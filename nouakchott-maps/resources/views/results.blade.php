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
    h1{
        font-size:50px;
        justify-content: center;
        text-align:center;
        font-weight:800;
    }
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap");
/* * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
} */
body {
  justify-content: center;
  align-items: center;
  background: #F9F6EE;
  min-height: 100vh;
}
.list {
  position: relative;
  /* margin-bottom:10px */
  display:block;
}
.list h2 {
  font-weight: 700;
  letter-spacing: 1px;
  margin-bottom: 10px;
  font-size:40px;
  margin-left: 40px;
}
.list ul {
  position: relative;
}
.list ul li {
  position: relative;
  left: 0;
  padding-left:2px;
  list-style: none;
  margin: 20px 0;
  border-left: 3px solid blue;
  transition: 0.5s;
  cursor: pointer;
}
.list ul li:hover {
  left: 10px;
}
.list ul li span {
  position: relative;
  padding: 8px;
  padding-left: 12px;
  display: inline-block;
  z-index: 1;
  transition: 0.5s;
}

.list ul li:before {
  content: "";
  position: absolute;
  width: 100%;
  height: 100%;
  transform: scaleX(0);
  transform-origin: left;
  transition: 0.5s;
}

.all{
    display:flex;
}
.show-route{
    border-radius:7px;
    padding:5px
}
</style>
<div class="all">

<div id="map" style="height: 670px;width:50%"></div>
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

    <div class="list">
        <h2>
            Les pharmacies les plus proches ⚕️
        </h2>
        <ul>
            @foreach ($pharmacies as $pharmacy)
                <li>
                    {{ $pharmacy->name }} - <span>{{ $pharmacy->distance }} meters</span>
                    <button onclick="showRoute({{ $pharmacy->latitude }}, {{ $pharmacy->longitude }})"  class="show-route">Show Route</button>
                </li>
            @endforeach
        </ul>
    </div>

</div>

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
