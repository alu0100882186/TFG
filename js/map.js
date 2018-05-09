function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 9.8,
    center: {lat: 28.2864769, lng: -16.5407172},
    mapTypeId: 'hybrid'
  });

  var rutaCoordenadas = [
    {lat:28.5458523, lng: -16.2031104 },
    {lat:28.5462293, lng: -16.193711915},
    {lat:28.549189, lng:-16.187575 },
    {lat:28.549066, lng: -16.185987 }
  ];

  var ruta = new google.maps.Polyline({
    path: rutaCoordenadas,
    geodesic: true,
    strokeColor: '#FF0000',
    strokeOpacity: 1.0,
    strokeWeight: 2
  });

  ruta.setMap(map);
}
