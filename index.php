<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
<style>
html { height: 100% }
body { height: 100%; margin: 0px; padding: 0px }
#map_canvas { height: 100% }
</style>
<title>Maps</title>
<script type="text/javascript">
  var map;
  var transparentOverlayState = {}
  
  var osmmapnik = new google.maps.ImageMapType({
	getTileUrl: function(ll, z) {
	  var X = ll.x % (1 << z);
	  if(Math.random() > 0.5) {
	  	if(Math.random() > 0.5) {
	  		return "http://a.tile.openstreetmap.org/" + z + "/" + X + "/" + ll.y + ".png";
	  	} else {
	  		return "http://b.tile.openstreetmap.org/" + z + "/" + X + "/" + ll.y + ".png";
	  	}
	  } else {
	  	return "http://a.osm.virtualearth.net/" + z + "/" + X + "/" + ll.y + ".png";
	  }
	  
	},
	tileSize: new google.maps.Size(256, 256),
	isPng: true,
	maxZoom: 18,
	name: "Mapnik (Bing)",
	alt: "Open Streetmap Mapnik (Bing)"
  });
  var openterrain = new google.maps.ImageMapType({
        getTileUrl: function(ll, z) {
          var X = ll.x % (1 << z);
          if(Math.random() > 0.5) {
                if(Math.random() > 0.5) {
                        return "http://c.tile.stamen.com/terrain-background/" + z + "/" + X + "/" + ll.y + ".png";
                } else {
                        return "http://b.tile.stamen.com/terrain-background/" + z + "/" + X + "/" + ll.y + ".png";
                }
          } else {
                return "http://a.tile.stamen.com/terrain-background/" + z + "/" + X + "/" + ll.y + ".png";
          }

        },
        tileSize: new google.maps.Size(256, 256),
        isPng: true,
        maxZoom: 18,
        name: "Terrain",
        alt: "Terrain"
  });

    /*Licensing...
    var wanderreitkarte = new google.maps.ImageMapType({
	getTileUrl: function(ll, z) {
	  var X = ll.x % (1 << z);
	  return "http://www.wanderreitkarte.de/base/" + z + "/" + X + "/" + ll.y + ".png";
	},
	tileSize: new google.maps.Size(256, 256),
	isPng: true,
	maxZoom: 18,
	name: "Wanderreitkarte",
	alt: "Wanderreitkarte"
  });*/
 
 var transportmap = new google.maps.ImageMapType({
	getTileUrl: function(ll, z) {
	  var X = ll.x % (1 << z);
	  if(Math.random() > 0.5) {
	  	if(Math.random() > 0.5) {
	  		return "http://c.tile2.opencyclemap.org/transport/" + z + "/" + X + "/" + ll.y + ".png";
	  	} else {
	  		return "http://b.tile2.opencyclemap.org/transport/" + z + "/" + X + "/" + ll.y + ".png";
	  	}
	  } else {
	  	return "http://a.tile2.opencyclemap.org/transport/" + z + "/" + X + "/" + ll.y + ".png";
	  }
	  
	},
	tileSize: new google.maps.Size(256, 256),
	isPng: true,
	maxZoom: 18,
	name: "Transport",
	alt: "Transport Map"
  });
  var osmarender = new google.maps.ImageMapType({
	getTileUrl: function(ll, z) {
	  var X = ll.x % (1 << z);
	  return "http://tah.openstreetmap.org/Tiles/tile/" + z + "/" + X + "/" + ll.y + ".png";
	},
	tileSize: new google.maps.Size(256, 256),
	isPng: true,
	maxZoom: 18,
	name: "Osmarender",
	alt: "Open Streetmap Osmarender"
  });
  var hikingmap = new google.maps.ImageMapType({
	getTileUrl: function(ll, z) {
	  var X = ll.x % (1 << z);
	  return "http://www.hiking.russellporter.com/hiking/" + z + "/" + X + "/" + ll.y + ".png";
	},
	tileSize: new google.maps.Size(256, 256),
	isPng: true,
	maxZoom: 21,
	name: "Hiking",
	alt: "Hiking Map"
  });
  var cyclemap = new google.maps.ImageMapType({
	getTileUrl: function(ll, z) {
	  var X = ll.x % (1 << z);
	  if(Math.random() > 0.5) {
	  	if(Math.random() > 0.5) {
	  		return "http://a.tile.opencyclemap.org/cycle/" + z + "/" + X + "/" + ll.y + ".png";
	  	} else {
	  		return "http://b.tile.opencyclemap.org/cycle/" + z + "/" + X + "/" + ll.y + ".png";
	  	}
	  } else {
	  	return "http://c.tile.opencyclemap.org/cycle/" + z + "/" + X + "/" + ll.y + ".png";
	  }
	  
	},
	tileSize: new google.maps.Size(256, 256),
	isPng: true,
	maxZoom: 18,
	name: "Bicycle",
	alt: "Cycle Map"
  });
  var hikebikemap = new google.maps.ImageMapType({
	getTileUrl: function(ll, z) {
	  var X = ll.x % (1 << z);
	  return "http://toolserver.org/tiles/hikebike/" + z + "/" + X + "/" + ll.y + ".png";
	},
	tileSize: new google.maps.Size(256, 256),
	isPng: true,
	maxZoom: 16,
	name: "Hiking",
	alt: "HikeBike Map"
  });
  var mapquestopen = new google.maps.ImageMapType({
	getTileUrl: function(ll, z) {
	  var X = ll.x % (1 << z);
	  return "http://otile4.mqcdn.com/tiles/1.0.0/osm/" + z + "/" + X + "/" + ll.y + ".png";
	},
	tileSize: new google.maps.Size(256, 256),
	isPng: true,
	maxZoom: 18,
	name: "Open Mapquest",
	alt: "Open Mapquest"
  });
  
  var osmpistemap = new google.maps.ImageMapType({
		    getTileUrl: function(ll, z) {
		      var X = ll.x % (1 << z);
		      return "http://tiles.openpistemap.org/contours/" + z + "/" + X + "/" + ll.y + ".png";
		    },
		    tileSize: new google.maps.Size(256, 256),
		    isPng: true,
		    maxZoom: 18,
		    name: "OpenPisteMap",
		    alt: "OpenPisteMap"
		  });


  var odblcoverage = new google.maps.ImageMapType({
	getTileUrl: function(ll, z) {
	  var X = ll.x % (1 << z);
	  return "http://osm.informatik.uni-leipzig.de/osm_tiles2/" + z + "/" + X + "/" + ll.y + ".png";
	},
	tileSize: new google.maps.Size(256, 256),
	isPng: true,
	maxZoom: 18,
	name: "ODBL Coverage",
	alt: "ODBL Coverage"
  });
  /*var openskimap = new google.maps.ImageMapType({
	getTileUrl: function(ll, z) {
	  var X = ll.x % (1 << z);
	  return "file://localhost/Users/russell/Sites/Open.skimap.org/tiles/" + z + "/" + X + "/" + ll.y + ".png";
	},
	tileSize: new google.maps.Size(256, 256),
	isPng: true,
	maxZoom: 18,
	name: "OpenSkiMap",
	alt: "OpenSkiMap"
  });*/
  var transparenthikingroutes = new google.maps.ImageMapType({
	getTileUrl: function(ll, z) {
	  var X = ll.x % (1 << z);
	  return "http://osm.lonvia.de/hiking/" + z + "/" + X + "/" + ll.y + ".png";
	},
	tileSize: new google.maps.Size(256, 256),
	isPng: true,
	maxZoom: 18,
	name: "Hiking Routes (Lonvia)",
	alt: "Hiking Routes (Lonvia)"
  });
  var transparenthillshades = new google.maps.ImageMapType({
	getTileUrl: function(ll, z) {
	  var X = ll.x % (1 << z);
	  return "http://toolserver.org/~cmarqu/hill/" + z + "/" + X + "/" + ll.y + ".png";
	},
	tileSize: new google.maps.Size(256, 256),
	isPng: true,
	maxZoom: 18,
	name: "Hillshades",
	alt: "Hillshades"
  });
  var transparentridethecity = new google.maps.ImageMapType({
	getTileUrl: function(ll, z) {
	  var X = ll.x % (1 << z);
	  return "http://tiles.ridethecity.com/tiles/bikes/" + z + "/" + X + "/" + ll.y + ".png";
	},
	tileSize: new google.maps.Size(256, 256),
	isPng: true,
	maxZoom: 18,
	name: "RideTheCity",
	alt: "RideTheCity"
  });
  
  var transparentsurfaces = new google.maps.ImageMapType({
	getTileUrl: function(ll, z) {
	  var X = ll.x % (1 << z);
	  return "http://osm.kosmosnimki.ru/surface/" + z + "/" + X + "/" + ll.y + ".png";
	},
	tileSize: new google.maps.Size(256, 256),
	isPng: true,
	maxZoom: 18,
	name: "RideTheCity",
	alt: "RideTheCity"
  });
  var transparentbuildings = new google.maps.ImageMapType({
	getTileUrl: function(ll, z) {
	  var X = ll.x % (1 << z);
	  return "http://osm.kosmosnimki.ru/buildings/" + z + "/" + X + "/" + ll.y + ".png";
	},
	tileSize: new google.maps.Size(256, 256),
	isPng: true,
	maxZoom: 18,
	name: "RideTheCity",
	alt: "RideTheCity"
  });
  var bergfex = new google.maps.ImageMapType({
  getTileUrl: function(coord, zoom) {
    return "http://static2.bergfex.at/images/amap/" + zoom + "/" + zoom + "_"+ coord.x + "_" + coord.y + ".png";
  },
  tileSize: new google.maps.Size(256, 256),
	isPng: true,
	maxZoom: 13,
	minZoom: 4,
	name: "Bergfex Austria",
	alt: "Bergfex Austria"
  });
  

  function initialize() {
	if(localStorage["slippy.lat"] != null) {
		var latlng = new google.maps.LatLng(localStorage["slippy.lat"],localStorage["slippy.lng"]);
		var zoom = Number(localStorage["slippy.zoom"]);
	} else {
		var zoom=2;
		var latlng = new google.maps.LatLng(40, -100);
	}
	var myOptions = {
	  zoom: zoom,
	  center: latlng,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	};
   
	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
  
  map.mapTypes.set('openterrain', openterrain); 
  map.mapTypes.set('mapquestopen', mapquestopen);
  map.mapTypes.set('odblcoverage', odblcoverage);
  map.mapTypes.set('osm', osmmapnik);
  //map.mapTypes.set('openskimap',openskimap);
  map.mapTypes.set('osma', osmarender);
  map.mapTypes.set('hikingmap', hikingmap);
  map.mapTypes.set('osmcycle', cyclemap);
  map.mapTypes.set('osmhike', hikebikemap);
  map.mapTypes.set('osmpiste',osmpistemap);
  map.mapTypes.set('bergfex', bergfex);
  map.mapTypes.set('transportmap',transportmap);
  /*map.mapTypes.set('wanderreitkarte', wanderreitkarte);*/
  map.setMapTypeId('osm');
  
  var optionsUpdate = {
	mapTypeControlOptions: {
	  mapTypeIds: ['hikingmap','osm','openterrain','osma','osmcycle','transportmap','osmhike','osmpiste','bergfex','mapquestopen','odblcoverage',google.maps.MapTypeId.ROADMAP,google.maps.MapTypeId.HYBRID,google.maps.MapTypeId.TERRAIN],
	  style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
	}
  };
  map.setOptions(optionsUpdate);
  //map.overlayMapTypes.insertAt(0, transparenthikingroutes);
  //map.overlayMapTypes.removeAt(0);
  transparentOverlayState['transparenthikingroutes'] = 0;
  transparentOverlayState['transparenthillshades'] = 0;
  transparentOverlayState['transparentridethecity'] = 0;
  transparentOverlayState['transparentsurfaces'] = 0;
  transparentOverlayState['transparentbuildings'] = 0;
  //transparentOverlayState['openskimap'] = 1;
  //map.overlayMapTypes.insertAt(1, openskimap);
  //map.overlayMapTypes.insertAt(1, transparenthillshades);
  //map.overlayMapTypes.removeAt(1);
  
	google.maps.event.addListener(map, 'center_changed', function() {
		document.getElementById("osmEditorLink").href = 'http://www.openstreetmap.org/edit?lat='+map.getCenter().lat()+'&lon='+map.getCenter().lng()+'&zoom='+map.getZoom();
	});
  }
function getLocation() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(success, error);
	} else {
		error('not supported');
	}
}
  function showHideOverlays(name) {
		if(name === 'transparenthillshades') {
			if(transparentOverlayState['transparenthillshades'] === 1) {
				//hide
				transparentOverlayState['transparenthillshades'] = 0;
				map.overlayMapTypes.removeAt(1);
			} else {
				transparentOverlayState['transparenthillshades'] = 1;
				map.overlayMapTypes.insertAt(1, transparenthillshades);
			}
		}
		/*if(name === 'openskimap') {
			if(transparentOverlayState['openskimap'] === 1) {
				//hide
				transparentOverlayState['openskimap'] = 0;
				map.overlayMapTypes.removeAt(1);
			} else {
				transparentOverlayState['openskimap'] = 1;
				map.overlayMapTypes.insertAt(1, openskimap);
			}
		}*/
		if(name === 'transparenthikingroutes') {
			if(transparentOverlayState['transparenthikingroutes'] === 1) {
				//hide
				transparentOverlayState['transparenthikingroutes'] = 0;
				map.overlayMapTypes.removeAt(0);
			} else {
				transparentOverlayState['transparenthikingroutes'] = 1;
				map.overlayMapTypes.insertAt(0, transparenthikingroutes);
			}
		}
		if(name === 'transparentsurfaces') {
			if(transparentOverlayState['transparentsurfaces'] === 1) {
				//hide
				transparentOverlayState['transparentsurfaces'] = 0;
				map.overlayMapTypes.removeAt(0);
			} else {
				transparentOverlayState['transparentsurfaces'] = 1;
				map.overlayMapTypes.insertAt(0, transparentsurfaces);
			}
		}
		if(name === 'transparentbuildings') {
			if(transparentOverlayState['transparentbuildings'] === 1) {
				//hide
				transparentOverlayState['transparentbuildings'] = 0;
				map.overlayMapTypes.removeAt(0);
			} else {
				transparentOverlayState['transparentbuildings'] = 1;
				map.overlayMapTypes.insertAt(0, transparentbuildings);
			}
		}
		if(name === 'transparentridethecity') {
			if(transparentOverlayState['transparentridethecity'] === 1) {
				//hide
				transparentOverlayState['transparentridethecity'] = 0;
				map.overlayMapTypes.removeAt(0);
			} else {
				transparentOverlayState['transparentridethecity'] = 1;
				map.overlayMapTypes.insertAt(0, transparentridethecity);
			}
		}
  }
function error() {}
function success(position) {
	var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
	map.setZoom(15);
	map.setCenter(latlng);
}
function unload() {
	localStorage.setItem("slippy.lat", map.getCenter().lat());
	localStorage.setItem("slippy.lng", map.getCenter().lng());
	localStorage.setItem("slippy.zoom", map.getZoom());
	GUnload();
}
  
</script>
</head>
<body onload="initialize()" onunload="unload()">
  <div id="map_canvas" style="width:100%; height:100%"></div>
  <div style="display:block;position:absolute; bottom:20px; opacity:0.8; right:0;width:200px; background:#eee"><p style="opacity:1.0; padding:10px;font-family:Helvetica; font-size:small" ><a style="cursor: pointer" onclick="getLocation();">Current Location</a><br/><a style="cursor: pointer" onclick="showHideOverlays('transparenthillshades');">Show/Hide Hillshades</a><br/><a style="cursor: pointer" onclick="showHideOverlays('transparentridethecity');">Show/Hide RideTheCity</a><br/><a style="cursor: pointer" onclick="showHideOverlays('transparenthikingroutes');">Show/Hide Hiking Routes</a><br/><a style="cursor: pointer" onclick="showHideOverlays('transparentsurfaces');">Show/Hide Surfaces</a><br/>
  <a id="osmEditorLink" href="">Edit in Potlatch 2</a><br/>
  <a style="cursor: pointer" onclick="showHideOverlays('transparentbuildings');">Show/Hide 3D Buildings</a><br/>By OpenStreetMap CC-BY-SA</p></div>
</body>
</html>
