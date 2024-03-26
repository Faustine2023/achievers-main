"use strict";

// initialize map
var map = new GMaps({
  div: '#map',
  lat: 23.014280,
  lng: 72.532057,
  zoomControl: false,
  fullscreenControl: false,
  mapTypeControl: true,
  mapTypeControlOptions: {
    mapTypeIds: []
  }
});
// Added a overlay to the map
map.drawOverlay({
  lat: 23.014280,
  lng: 72.532057,
  content: '<div class="popover" style="width:250px;"><div class="manual-arrow"><i class="fas fa-caret-down"></i></div><div class="popover-body"><b>Achievers</b><p><small>Kenya, <br>Kayole, Nairobi</p><p><a target="_blank" href="index.html">Website</a></small></p></div></div>'
});
