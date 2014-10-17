/*function initialize() {
  var mapOptions = {
    zoom: 8,
    center: new google.maps.LatLng(-34.397, 150.644)
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
  console.log('initialize');
}

function loadScript() {
  var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&amp;callback=initialize';
  document.body.appendChild(script);
  console.log('load');
}

window.onload = loadScript;*/

$( document ).ready(function() {
  $(".header").corner("20px bottom");
  $(".content").corner("20px");
  $(".buttonSwitch").corner("5px");
  $(".panelFind").hide();
  $(".panelPost").hide();
});